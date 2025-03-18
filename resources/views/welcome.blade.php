<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern School Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .slider {
            background: url('https://source.unsplash.com/1600x600/?school,classroom') no-repeat center center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-indigo-600">School Name</div>
            <nav class="space-x-6">
                <a href="#" class="text-gray-700 hover:text-indigo-600">Home</a>
                <a href="#admission" class="text-gray-700 hover:text-indigo-600">Admission</a>
                <a href="#courses" class="text-gray-700 hover:text-indigo-600">Courses</a>
                <a href="#contact" class="text-gray-700 hover:text-indigo-600">Contact</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700" wire:navigate>Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700"
                        wire:navigate>Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Slider Section -->
    <section class="slider">
        <div class="bg-black bg-opacity-50 p-6 rounded-lg">
            Welcome to Our Modern School Website
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12">

        <!-- Admission Section -->
        <section id="admission" class="mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Admission</h2>
            <p class="text-gray-600 leading-relaxed mb-6">
                Join our school by filling out the admission form. We provide quality education with top-notch
                facilities.
            </p>
            <form class="bg-white p-6 rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="name">Full Name</label>
                        <input type="text" id="name" placeholder="Full Name"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
                        <input type="email" id="email" placeholder="Email"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="phone">Phone</label>
                        <input type="text" id="phone" placeholder="Phone Number"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="course">Select Course</label>
                        <select id="course"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option>Science</option>
                            <option>Mathematics</option>
                            <option>History</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg mt-4 hover:bg-indigo-700">Submit
                    Admission</button>
            </form>
        </section>

        <!-- Courses Section -->
        <section id="courses" class="mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Science</h3>
                    <p class="text-gray-600">Explore the world of physics, chemistry, and biology with us.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Mathematics</h3>
                    <p class="text-gray-600">Sharpen your analytical and problem-solving skills.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">History</h3>
                    <p class="text-gray-600">Learn about significant historical events and figures.</p>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Contact Us</h2>
            <form class="bg-white p-6 rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="contact-name">Name</label>
                        <input type="text" id="contact-name" placeholder="Your Name"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="contact-email">Email</label>
                        <input type="email" id="contact-email" placeholder="Your Email"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 font-bold mb-2" for="message">Message</label>
                    <textarea id="message" rows="4" placeholder="Your Message"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
                </div>
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg mt-4 hover:bg-indigo-700">Send Message</button>
            </form>
        </section>

        <!-- Login Section -->
        {{-- <section id="login" class="mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Login</h2>
            <form class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
                    <input type="text" id="username" placeholder="Username"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                    <input type="password" id="password" placeholder="Password"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Login</button>
            </form>
        </section> --}}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        &copy; 2025 School Name. All rights reserved.
    </footer>

</body>

</html>
