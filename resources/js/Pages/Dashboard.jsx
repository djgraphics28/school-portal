import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-10xl sm:px-6 lg:px-8">
                    {/* Main Dashboard Container */}
                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

                        {/* Card for Total Students */}
                        <div className="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <h3 className="text-2xl font-semibold text-gray-800">Total Students</h3>
                                <p className="text-sm text-gray-500">All students enrolled in the system.</p>
                            </div>
                            <div className="text-4xl font-bold text-blue-600">500</div>
                        </div>

                        {/* Card for Teachers */}
                        <div className="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <h3 className="text-2xl font-semibold text-gray-800">Total Teachers</h3>
                                <p className="text-sm text-gray-500">Total number of teachers currently active.</p>
                            </div>
                            <div className="text-4xl font-bold text-green-600">35</div>
                        </div>

                        {/* Card for Active Classes */}
                        <div className="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <h3 className="text-2xl font-semibold text-gray-800">Active Classes</h3>
                                <p className="text-sm text-gray-500">Currently active and ongoing classes.</p>
                            </div>
                            <div className="text-4xl font-bold text-yellow-600">12</div>
                        </div>
                    </div>

                    {/* Analytics Section */}
                    <div className="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        {/* Recent Activities */}
                        <div className="bg-white p-6 rounded-lg shadow-md">
                            <h3 className="text-xl font-semibold text-gray-800">Recent Activities</h3>
                            <ul className="mt-4 text-gray-600">
                                <li className="flex justify-between py-2 border-b border-gray-200">
                                    <span>New Student Enrolled</span>
                                    <span className="text-sm text-gray-500">3 minutes ago</span>
                                </li>
                                <li className="flex justify-between py-2 border-b border-gray-200">
                                    <span>Teacher Assigned to Class</span>
                                    <span className="text-sm text-gray-500">20 minutes ago</span>
                                </li>
                                <li className="flex justify-between py-2">
                                    <span>Class Scheduled</span>
                                    <span className="text-sm text-gray-500">1 hour ago</span>
                                </li>
                            </ul>
                        </div>

                        {/* Student Performance Chart */}
                        <div className="bg-white p-6 rounded-lg shadow-md">
                            <h3 className="text-xl font-semibold text-gray-800">Student Performance</h3>
                            <div className="mt-4 bg-gray-200 h-32 rounded-lg"> {/* Placeholder for chart */}</div>
                            <p className="mt-4 text-gray-600">Graphical analysis of student performance across subjects.</p>
                        </div>

                        {/* Upcoming Events */}
                        <div className="bg-white p-6 rounded-lg shadow-md">
                            <h3 className="text-xl font-semibold text-gray-800">Upcoming Events</h3>
                            <ul className="mt-4 text-gray-600">
                                <li className="flex justify-between py-2 border-b border-gray-200">
                                    <span>Parent-Teacher Meeting</span>
                                    <span className="text-sm text-gray-500">Feb 10, 2025</span>
                                </li>
                                <li className="flex justify-between py-2 border-b border-gray-200">
                                    <span>School Sports Day</span>
                                    <span className="text-sm text-gray-500">Feb 15, 2025</span>
                                </li>
                                <li className="flex justify-between py-2">
                                    <span>Exam Week</span>
                                    <span className="text-sm text-gray-500">Feb 20, 2025</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
