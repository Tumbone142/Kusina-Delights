<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,chef,user',
            'profile.first_name' => 'required|string|max:100',
            'profile.last_name' => 'required|string|max:100',
            'profile.middle_name' => 'nullable|string|max:100',
            'profile.introduction' => 'nullable|string',
            'profile.profile_image' => 'nullable|image|max:2048',
            'chef.income' => 'nullable|numeric|min:0',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'Roles' => $validated['role'], // Ensure this is using the correct field name
            ]);
    
            // Profile data
            $profileData = $validated['profile'];
    
            if ($request->hasFile('profile.profile_image')) {
                $imagePath = $request->file('profile.profile_image')->store('profile_images', 'public');
                $profileData['profile_image'] = $imagePath;
            }
    
            // Create the profile
            $user->profile()->create([
                'FirstName' => $profileData['first_name'],
                'MiddleName' => $profileData['middle_name'],
                'LastName' => $profileData['last_name'],
                'Introduction' => $profileData['introduction'],
                'ProfileImage' => $profileData['profile_image'],
                'Created_by' => Auth::id(),
            ]);
    
            // Handle chef-specific creation
            if ($user->Roles === 'chef') {
                $user->chef()->create([
                    'Income' => $validated['chef']['income'] ?? 0, // Ensure we are getting the income from the validated data
                    'Created_by' => Auth::id(),
                ]);
            }
    
            DB::commit();
    // auth login
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('There was an error creating the user. ' . $e->getMessage());
        }
    }
    
    public function show($id)
    {
        $user = User::with('profile', 'chef')->findOrFail($id);
    
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }
    



    public function edit($id)
    {
        $user = User::with('profile', 'chef')->findOrFail($id);
    
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        Log::info("Incoming request data for user ID {$id}: ", $request->all());
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,chef,user',
            'profile.first_name' => 'required|string|max:100',
            'profile.last_name' => 'required|string|max:100',
            'profile.middle_name' => 'nullable|string|max:100',
            'profile.introduction' => 'nullable|string',
            'profile.profile_image' => 'nullable|string|starts_with:data:image/', // Validating base64 string
            'chef.income' => 'nullable|numeric|min:0',
        ]);
    
        $user = User::with('profile', 'chef')->findOrFail($id);
    
        DB::beginTransaction();
    
        try {
            // Update user details
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
                'Roles' => $validated['role'],
            ]);
    
            // Handle profile image upload if base64 string is provided
            $profileData = [
                'FirstName' => $validated['profile']['first_name'],
                'LastName' => $validated['profile']['last_name'],
                'MiddleName' => $validated['profile']['middle_name'],
                'Introduction' => $validated['profile']['introduction'],
                'Created_by' => Auth::id(),
            ];
    
            if (!empty($validated['profile']['profile_image'])) {
                // Decode the base64 image
                $base64Image = $validated['profile']['profile_image'];
                $imageParts = explode(';base64,', $base64Image);
                $imageType = explode('/', $imageParts[0])[1]; // Get the image type (e.g., png, jpeg)
                $imageBase64 = base64_decode($imageParts[1]);
    
                // Generate a unique file name for the image
                $fileName = uniqid() . '.' . $imageType;
                $filePath = 'profile_images/' . $fileName;
    
                // Save the image to public storage
                Storage::disk('public')->put($filePath, $imageBase64);
    
                // Set the profile image path to the relative file path
                $profileData['ProfileImage'] = $filePath;
    
                // Optionally, delete the old image file if a new one is uploaded
                if ($user->profile->ProfileImage) {
                    Storage::disk('public')->delete($user->profile->ProfileImage);
                }
    
                Log::info("Profile image saved to: {$filePath}");
            } else {
                // Retain the existing profile image if no new image is uploaded
                $profileData['ProfileImage'] = $user->profile->ProfileImage ?? null;
            }
    
            // Update profile information
            $user->profile()->update($profileData);
    
            // Handle chef-specific data
            if ($user->Roles !== 'chef' && $user->chef) {
                $user->chef()->delete();
            }
    
            if ($validated['role'] === 'chef') {
                $user->chef()->updateOrCreate([], [
                    'Income' => $validated['chef']['income'] ?? 0,
                    'Created_by' => Auth::id(),
                ]);
            }
    
            DB::commit();
    
            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error("Error updating user ID {$id}: " . $e->getMessage(), [
                'exception' => $e,
                'user_id' => $id,
                'validated_data' => $validated,
            ]);
    
            return back()->withErrors('Error updating user. Please check the logs for more details.');
        }
    }
    
    
    
    
    

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
