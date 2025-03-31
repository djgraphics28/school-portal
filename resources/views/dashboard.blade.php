<x-layouts.app title="Home News Feed">
    <div class="flex flex-col gap-8 p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">

        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">School News Feed</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">Stay updated with the latest events, announcements, and posts.</p>
            </div>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                + Add Post
            </button>
        </div>

        <!-- Events Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-blue-600 dark:text-blue-400">📅 Upcoming Events</h2>
            <div class="grid gap-6 md:grid-cols-3 mt-4">

                <!-- Event Card -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-blue-500 dark:text-blue-300">Science Fair 2025</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Date: April 12, 2025</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">Join us for an amazing display of student science projects.</p>
                    <button class="mt-4 text-blue-600 dark:text-blue-400 hover:underline">View Details →</button>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-green-500 dark:text-green-300">Sports Fest</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Date: May 3, 2025</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">An exciting day of sports activities and competitions.</p>
                    <button class="mt-4 text-green-600 dark:text-green-400 hover:underline">View Details →</button>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-orange-500 dark:text-orange-300">Graduation Ceremony</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Date: June 15, 2025</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">Celebrate the achievements of our graduates.</p>
                    <button class="mt-4 text-orange-600 dark:text-orange-400 hover:underline">View Details →</button>
                </div>
            </div>
        </div>

        <!-- Announcements Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-purple-600 dark:text-purple-400">📢 Announcements</h2>
            <div class="divide-y divide-gray-200 dark:divide-gray-700 mt-4">

                <!-- Announcement Item -->
                <div class="py-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Enrollment for 2025 Now Open!</h3>
                    <p class="text-gray-600 dark:text-gray-400">Posted on: March 25, 2025</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">Students can now enroll for the next academic year. Check the requirements and deadlines.</p>
                </div>

                <div class="py-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Library Renovation Notice</h3>
                    <p class="text-gray-600 dark:text-gray-400">Posted on: March 20, 2025</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">The school library will be closed for renovation from April 1 to May 1.</p>
                </div>

                <div class="py-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">New Club Registrations</h3>
                    <p class="text-gray-600 dark:text-gray-400">Posted on: March 18, 2025</p>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">Join a variety of clubs including music, dance, and tech clubs. Register by April 5th.</p>
                </div>

            </div>
        </div>

        <!-- Recent Posts Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-teal-600 dark:text-teal-400">📰 Recent Posts</h2>
            <div class="grid md:grid-cols-3 gap-6 mt-4">

                <!-- Post Card -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-gray-600 dark:text-gray-400">Post Image</span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">New Canteen Menu</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">March 22, 2025</p>
                        <p class="text-gray-700 dark:text-gray-300 mt-2">Check out the new menu with healthier options and student discounts!</p>
                        <button class="mt-4 text-teal-600 dark:text-teal-400 hover:underline">Read More →</button>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-gray-600 dark:text-gray-400">Post Image</span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Coding Bootcamp</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">March 20, 2025</p>
                        <p class="text-gray-700 dark:text-gray-300 mt-2">Learn coding skills in this intensive 3-week program. Sign up today!</p>
                        <button class="mt-4 text-teal-600 dark:text-teal-400 hover:underline">Read More →</button>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-gray-600 dark:text-gray-400">Post Image</span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Art Exhibit</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">March 18, 2025</p>
                        <p class="text-gray-700 dark:text-gray-300 mt-2">Experience the creativity of our students at the annual art exhibit.</p>
                        <button class="mt-4 text-teal-600 dark:text-teal-400 hover:underline">Read More →</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
