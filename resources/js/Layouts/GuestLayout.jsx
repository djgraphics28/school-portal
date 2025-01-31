import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    const appName = window.Laravel.appName;
    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 to-gray-50">
            <div className="grid min-h-screen grid-cols-1 md:grid-cols-2">
                {/* Left Column - School Image */}
                <div className="hidden md:flex bg-green-900 items-center justify-center p-12">
                    <img
                        src="/images/school-image.png"
                        alt="School Campus"
                        className="w-full h-full object-cover rounded-lg shadow-xl"
                    />
                </div>

                {/* Right Column - Content */}
                <div className="flex flex-col items-center justify-center p-6 sm:p-12">
                    {/* Header Section */}
                    <div className="w-full max-w-md space-y-4">
                        <Link href="/" className="flex items-center justify-center">
                            <ApplicationLogo className="h-24 w-24 fill-current text-green-600" />
                        </Link>
                        <div className="text-center">
                            <h1 className="text-3xl font-bold text-gray-900">Welcome to {appName}</h1>
                            <p className="mt-2 text-gray-600">Excellence in Education Since 1994</p>
                        </div>
                    </div>

                    {/* Form Container */}
                    <div className="mt-8 w-full max-w-md bg-white rounded-xl shadow-2xl p-8 space-y-6">
                        {children}
                    </div>

                    {/* Footer */}
                    <div className="mt-8 text-center text-sm text-gray-600">
                        <p>© 2025 {appName}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    );
}
