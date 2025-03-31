<x-layouts.app title="Home News Feed">
    <div class="flex flex-col gap-8 p-6 bg-gray-100 min-h-screen">

        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-md p-8 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">School News Feed</h1>
                <p class="text-lg text-gray-500">Stay updated with the latest events, announcements, and posts.</p>
            </div>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                + Add Post
            </button>
        </div>

        <!-- Events Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-blue-600">📅 Upcoming Events</h2>
            <div class="grid gap-6 md:grid-cols-3 mt-4">

                <!-- Event Card -->
                <div class="bg-blue-50 rounded-lg p-4 shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-blue-800">Science Fair 2025</h3>
                    <p class="text-sm text-gray-600">Date: April 12, 2025</p>
                    <p class="text-gray-700 mt-2">Join us for an amazing display of student science projects.</p>
                    <button class="mt-4 text-blue-600 hover:underline">View Details →</button>
                </div>

                <div class="bg-green-50 rounded-lg p-4 shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-green-800">Sports Fest</h3>
                    <p class="text-sm text-gray-600">Date: May 3, 2025</p>
                    <p class="text-gray-700 mt-2">An exciting day of sports activities and competitions.</p>
                    <button class="mt-4 text-green-600 hover:underline">View Details →</button>
                </div>

                <div class="bg-orange-50 rounded-lg p-4 shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-orange-800">Graduation Ceremony</h3>
                    <p class="text-sm text-gray-600">Date: June 15, 2025</p>
                    <p class="text-gray-700 mt-2">Celebrate the achievements of our graduates.</p>
                    <button class="mt-4 text-orange-600 hover:underline">View Details →</button>
                </div>
            </div>
        </div>

        <!-- Announcements Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-purple-600">📢 Announcements</h2>
            <div class="divide-y divide-gray-200 mt-4">

                <!-- Announcement Item -->
                <div class="py-4">
                    <h3 class="text-lg font-bold text-gray-800">Enrollment for 2025 Now Open!</h3>
                    <p class="text-gray-600">Posted on: March 25, 2025</p>
                    <p class="text-gray-700 mt-2">Students can now enroll for the next academic year. Check the requirements and deadlines.</p>
                </div>

                <div class="py-4">
                    <h3 class="text-lg font-bold text-gray-800">Library Renovation Notice</h3>
                    <p class="text-gray-600">Posted on: March 20, 2025</p>
                    <p class="text-gray-700 mt-2">The school library will be closed for renovation from April 1 to May 1.</p>
                </div>

                <div class="py-4">
                    <h3 class="text-lg font-bold text-gray-800">New Club Registrations</h3>
                    <p class="text-gray-600">Posted on: March 18, 2025</p>
                    <p class="text-gray-700 mt-2">Join a variety of clubs including music, dance, and tech clubs. Register by April 5th.</p>
                </div>

            </div>
        </div>

        <!-- Recent Posts Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-teal-600">📰 Recent Posts</h2>
            <div class="grid md:grid-cols-3 gap-6 mt-4">

                <!-- Post Card -->
                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="https://via.placeholder.com/600x400" alt="Post Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800">New Canteen Menu</h3>
                        <p class="text-gray-600 text-sm">March 22, 2025</p>
                        <p class="text-gray-700 mt-2">Check out the new menu with healthier options and student discounts!</p>
                        <button class="mt-4 text-teal-600 hover:underline">Read More →</button>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="https://via.placeholder.com/600x400" alt="Post Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800">Coding Bootcamp</h3>
                        <p class="text-gray-600 text-sm">March 20, 2025</p>
                        <p class="text-gray-700 mt-2">Learn coding skills in this intensive 3-week program. Sign up today!</p>
                        <button class="mt-4 text-teal-600 hover:underline">Read More →</button>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="https://via.placeholder.com/600x400" alt="Post Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800">Art Exhibit</h3>
                        <p class="text-gray-600 text-sm">March 18, 2025</p>
                        <p class="text-gray-700 mt-2">Experience the creativity of our students at the annual art exhibit.</p>
                        <button class="mt-4 text-teal-600 hover:underline">Read More →</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
