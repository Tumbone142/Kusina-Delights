<template>
    <Layout>
        <div class="relative h-[362px]">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://c.animaapp.com/Rn1lwNvc/img/unsplash-hrlvr2zlunk.png'); filter: brightness(0.7);"></div>
            <div class="flex items-center justify-center h-full relative">
                <p class="text-white text-center px-4 text-large font-bold drop-shadow-xl white-shadow">
                    Halo Halo
                </p>
            </div>
        </div>

        <!-- Centered Ingredients and Preparation Section -->
        <div class="mx-auto text-left max-w-4xl my-4 text-small text-black-100 space-y-4">
            <div>
                <p class="text-small font-bold">Ingredients</p>
                <p>2 cups shaved ice</p>
                <p>1/2 cup evaporated milk</p>
                <p>1/4 cup sweetened red beans</p>
                <p>1/4 cup sweetened garbanzos (chickpeas)</p>
                <p>1/4 cup nata de coco (coconut gel)</p>
                <p>1/4 cup sweetened jackfruit (langka)</p>
                <p>1/4 cup sweetened banana (saba variety)</p>
                <p>1/4 cup sweetened macapuno (coconut sport)</p>
                <p>1/4 cup ube halaya (purple yam jam)</p>
                <p>1 slice leche flan</p>
                <p>1 scoop ube or mango ice cream (optional)</p>
                <p>Pinch of pinipig (crisped rice) or rice puffs</p>
            </div>

            <div>
                <p class="text-normal font-bold">How To Prepare</p>
                <p><span class="text-small font-bold">Prepare the toppings :</span> Gather the sweetened beans, garbanzos, nata de coco, sweetened fruits, and ube halaya. You can find these pre-made or make them by boiling and sweetening them with sugar syrup.</p>
                <p><span class="text-small font-bold">Assemble in layers :</span> In a tall glass or bowl, place a tablespoon of each of the sweetened beans, garbanzos, nata de coco, and sweetened fruits at the bottom.</p>
                <p><span class="text-small font-bold">Add shaved ice :</span> Add a generous amount of shaved ice to the top, compacting it slightly as you go.</p>
                <p><span class="text-small font-bold">Pour evaporated milk :</span> Slowly pour the evaporated milk over the ice until it soaks through the layers.</p>
                <p><span class="text-small font-bold">Top with leche flan, ube, and ice cream :</span> Place a slice of leche flan on top, add a spoonful of ube halaya, and finish with a scoop of ice cream. Optionally, sprinkle with pinipig.</p>
                <p><span class="text-small font-bold">Serve and mix :</span> Serve with a long spoon. Halo-halo is meant to be stirred before eating, so you mix all the ingredients together for a combination of flavors.</p>
            </div>

            <div>
                <p class="font-bold">Additional Information</p>
                <p>Halo-halo is a signature Filipino dessert often enjoyed during hot weather. The key to a good halo-halo is the variety and quality of the ingredients, which provide a contrast in textures and flavors, from creamy and sweet to crunchy and fruity.</p>
            </div>
        </div>

       <!-- Expanded Reviews Section -->
       <div class="p-6 bg-gray-100 rounded-lg max-w-6xl mx-auto space-y-4 mt-8">
            <h2 class="text-2xl font-bold">Reviews</h2>

                <!-- Review Items -->
    <div class="bg-gray-200 rounded-lg p-4 space-y-4">
        <!-- Individual Review -->
        <div class="bg-white rounded-lg p-4 flex justify-between items-start shadow-sm">
            <div>
                <p class="flex items-center text-gray-700 font-bold">
                    <span class="material-icons mr-2 text-yellow-500">person</span> Anonymous_UserV2
                </p>
                <p class="text-gray-600 mt-1">HOLY MOLLY, This #$@!#% is absolutely Outstanding of a dessert, I FWTS.</p>
            </div>
            <div class="flex items-center">
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 flex justify-between items-start shadow-sm">
            <div>
                <p class="flex items-center text-gray-700 font-bold">
                    <span class="material-icons mr-2 text-yellow-500">person</span> Code_Celestia
                </p>
                <p class="text-gray-600 mt-1">Kalami sa makaon ONG NGL FR FR FR REAL</p>
            </div>
            <div class="flex items-center">
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-gray-300">star</span>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 flex justify-between items-start shadow-sm">
            <div>
                <p class="flex items-center text-gray-700 font-bold">
                    <span class="material-icons mr-2 text-yellow-500">person</span> Anonymous_User
                </p>
                <p class="text-gray-600 mt-1">Awesome Recipe</p>
            </div>
            <div class="flex items-center">
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-black">star</span>
                <span class="material-icons text-gray-300">star</span>
                <span class="material-icons text-gray-300">star</span>
            </div>
        </div>
    </div>

            <!-- Add Review Section -->
            <h3 class="text-xl font-bold mt-6">Write a Review</h3>
            <div class="bg-gray-200 rounded-lg p-4 space-y-3">
                <textarea placeholder="Review*" class="w-full p-3 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-300 resize-none text-small"></textarea>

                <!-- Flex Container for Username and Rating -->
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Username*" class="w-1/2 p-3 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-300 text-small" />
                    
                    <!-- Adjustable Rating Stars -->
                    <div class="flex items-center space-x-2">
                        <label class="text-gray-700 font-semibold">Rate</label>
                        <div class="flex items-center space-x-1 text-2xl">
                            <span v-for="star in 5" :key="star" @click="setRating(star)" class="material-icons cursor-pointer"
                                :class="{'text-black': rating >= star, 'text-gray-300': rating < star}">
                                star
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-start space-x-2 mt-4">
                    <button class="bg-green-400 text-white font-semibold py-2 px-36 rounded-2xl hover:bg-green-500 text-small">Submit Review</button>
                    <button class="bg-red-400 text-white font-semibold py-2 px-28 rounded-2xl hover:bg-red-500 text-small">Cancel</button>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/frontend.vue';

export default {
    components: {
        Layout,
    },
    data() {
        return {
            rating: 0, 
        };
    },
    methods: {
        setRating(star) {
            this.rating = star;
        },
    },
};
</script>

<style scoped>
/* Optional styling adjustments */
</style>