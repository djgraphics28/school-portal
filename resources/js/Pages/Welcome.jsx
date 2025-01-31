import { Head, Link } from '@inertiajs/react';

export default function Welcome({ auth }) {
    return (
        <div className="min-h-screen bg-gray-100">
            <Head title="School Portal" />

            {/* Navigation Bar */}
            <nav className="bg-blue-600 text-white py-4 px-6 flex justify-between items-center">
                <h1 className="text-2xl font-bold">School Portal</h1>
                <div>
                    <Link href="/" className="px-4">Home</Link>
                    <Link href="/courses" className="px-4">Courses</Link>
                    <Link href="/contact" className="px-4">Contact Us</Link>
                    {auth.user ? (
                        <>
                            <Link href="/account" className="px-4">Account</Link>
                            <Link href="/logout" className="px-4">Logout</Link>
                        </>
                    ) : (
                        <>
                            <Link href="/login" className="px-4">Login</Link>
                            <Link href="/register" className="px-4">Register</Link>
                        </>
                    )}
                </div>
            </nav>

            {/* Hero Section */}
            <header className="relative bg-blue-600 text-white py-20 px-4 text-center">
                <div className="absolute inset-0 bg-cover bg-center opacity-30" style={{ backgroundImage: "url('/path-to-your-image.jpg')" }}></div>
                <div className="relative z-10">
                    <h1 className="text-4xl font-extrabold">Welcome to Our School Portal</h1>
                    <p className="mt-4 text-lg">Your gateway to a smarter learning experience</p>
                    <div className="mt-6">
                        {auth.user ? (
                            <Link href="/dashboard" className="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow-md">Go to Dashboard</Link>
                        ) : (
                            <>
                                <Link href="/register" className="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow-md mr-4">Register</Link>
                                <Link href="/login" className="bg-gray-200 text-blue-600 px-6 py-3 rounded-lg font-bold shadow-md">Login</Link>
                            </>
                        )}
                    </div>
                </div>
            </header>

            {/* Features Section */}
            <section className="py-16 px-6 bg-white">
                <div className="max-w-6xl mx-auto text-center">
                    <h2 className="text-3xl font-bold text-gray-800">Why Choose Our Portal?</h2>
                    <p className="text-gray-600 mt-3">We provide an all-in-one platform for students, teachers, and parents.</p>
                    <div className="mt-10 grid md:grid-cols-3 gap-8">
                        <div className="bg-gray-100 p-6 rounded-lg shadow-md">
                            <img src="/free-image-1.jpg" alt="Feature 1" className="w-full h-40 object-cover rounded-md" />
                            <h3 className="mt-4 text-xl font-semibold">Easy Access to Learning Materials</h3>
                            <p className="mt-2 text-gray-600">All your study resources in one place.</p>
                        </div>
                        <div className="bg-gray-100 p-6 rounded-lg shadow-md">
                            <img src="/free-image-2.jpg" alt="Feature 2" className="w-full h-40 object-cover rounded-md" />
                            <h3 className="mt-4 text-xl font-semibold">Stay Connected</h3>
                            <p className="mt-2 text-gray-600">Communicate with teachers and classmates effortlessly.</p>
                        </div>
                        <div className="bg-gray-100 p-6 rounded-lg shadow-md">
                            <img src="/free-image-3.jpg" alt="Feature 3" className="w-full h-40 object-cover rounded-md" />
                            <h3 className="mt-4 text-xl font-semibold">Track Your Progress</h3>
                            <p className="mt-2 text-gray-600">Monitor your grades and assignments in real time.</p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Call to Action */}
            <footer className="bg-blue-600 text-white text-center py-10">
                <h2 className="text-2xl font-bold">Get Started Today!</h2>
                <p className="mt-2">Join now and take control of your learning journey.</p>
                <div className="mt-4">
                    {auth.user ? (
                        <Link href="/dashboard" className="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow-md">Go to Dashboard</Link>
                    ) : (
                        <>
                            <Link href="/register" className="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow-md mr-4">Register</Link>
                            <Link href="/login" className="bg-gray-200 text-blue-600 px-6 py-3 rounded-lg font-bold shadow-md">Login</Link>
                        </>
                    )}
                </div>
            </footer>
        </div>
    );
}
