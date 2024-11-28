<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;  // Include UserProfile model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;  // Add Log facade
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:' . User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                // Optional profile fields validation
                'FirstName' => 'nullable|string|max:255',
                'MiddleName' => 'nullable|string|max:255',
                'LastName' => 'nullable|string|max:255',
                'ProfileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional profile image validation
                'Introduction' => 'nullable|string',
            ]);

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Only create the user profile if the profile data is provided
            if ($request->filled(['FirstName', 'LastName'])) {
                $userProfile = UserProfile::create([
                    'user_id' => $user->id,
                    'FirstName' => $request->FirstName,
                    'MiddleName' => $request->MiddleName,
                    'LastName' => $request->LastName,
                    'ProfileImage' => $request->ProfileImage,  // Handle profile image (optional)
                    'Introduction' => $request->Introduction,
                    'Created_by' => $user->id,  // Assuming the user who creates the profile is the same user
                ]);
            }

            // Trigger the Registered event
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Redirect to the dashboard or any other page
            return redirect(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            // Log the exception to the Laravel log file
            Log::error('User registration failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_data' => $request->all(),  // Optionally log the request data
            ]);

            // Optionally, you can return a response or error view
            return back()->withErrors(['error' => 'Something went wrong during registration. Please try again later.']);
        }
    }
}
