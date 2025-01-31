import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import NavLink from "@/Components/NavLink";
import { Link, usePage } from "@inertiajs/react";
import { useState } from "react";
import {
    Home,
    ClipboardList,
    Calendar,
    ChevronLeft,
    ChevronRight,
    Menu,
    Users,
    DoorOpen,
    UserCircle2,
    User2Icon,
    UserCheckIcon,
    FormInputIcon,
    ListIcon,
    MessageCircle,
} from "lucide-react";

export default function AuthenticatedLayout({ header, children }) {
    const user = usePage().props.auth.user;
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);
    const [showingSidebar, setShowingSidebar] = useState(true);
    const [mobileSidebarOpen, setMobileSidebarOpen] = useState(false);
    const appName = window.Laravel.appName;

    return (
        <div className="min-h-screen bg-gray-50 flex">
            {/* Mobile Sidebar Overlay */}
            {mobileSidebarOpen && (
                <div
                    className="fixed inset-0 bg-black/50 z-40 md:hidden"
                    onClick={() => setMobileSidebarOpen(false)}
                />
            )}

            {/* Sidebar - Collapsible */}
            <div
                className={`fixed inset-y-0 left-0 md:relative transform ${
                    mobileSidebarOpen
                        ? "translate-x-0"
                        : "-translate-x-full md:translate-x-0"
                } ${
                    showingSidebar ? "md:w-64" : "md:w-16"
                } bg-green-900 text-white shadow-lg transition-all duration-300 ease-in-out z-50`}
            >
                {/* Sidebar Header with User Photo & Collapse Button */}
                <div className="flex flex-col items-center justify-between px-4 py-4">
                    {/* Desktop Collapse Button - Placed Above Profile Picture */}
                    <button
                        hidden={mobileSidebarOpen}
                        onClick={() => setShowingSidebar(!showingSidebar)}
                        className="p-2 rounded-md text-white hover:bg-green-800 mb-4"
                    >
                        {showingSidebar ? (
                            <ChevronLeft className="h-5 w-5" />
                        ) : (
                            <ChevronRight className="h-5 w-5" />
                        )}
                    </button>

                    {/* Profile Information */}
                    <div className="flex flex-col items-center">
                        {/* Profile Picture */}
                        <img
                            src={user.profile_photo_url || "/images/user.png"}
                            alt="User photo"
                            className={`rounded-full border-2 border-white transition-all duration-300 ${
                                showingSidebar ? "h-24 w-24" : "h-8 w-8" // Smaller size when showingSidebar is false
                            }`}
                        />

                        {/* User Info (Name & Email) */}
                        {showingSidebar && (
                            <div className="text-center">
                                <span className="text-lg font-semibold block">
                                    {user.name}
                                </span>
                                <span className="text-sm text-white-500 block">
                                    {user.email}
                                </span>
                            </div>
                        )}
                    </div>
                </div>

                {/* Navigation Links */}
                <div className="mt-4 space-y-1 px-2">
                    <NavLink
                        icon={<Home className="h-5 w-5" />}
                        href={route("dashboard")}
                        active={route().current("dashboard")}
                        text="Dashboard"
                        showingSidebar={showingSidebar}
                        className="text-white hover:bg-green-800"
                        activeClassName="bg-green-800"
                    />
                    <NavLink
                        icon={<DoorOpen className="h-5 w-5" />}
                        text="Registration"
                        showingSidebar={showingSidebar}
                        className="text-white hover:bg-green-800"
                        activeClassName="bg-green-800"
                    />
                    <NavLink
                        icon={<Users className="h-5 w-5" />}
                        text="Students"
                        showingSidebar={showingSidebar}
                        className="text-white hover:bg-green-800"
                        activeClassName="bg-green-800"
                    />
                    <NavLink
                        icon={<UserCheckIcon className="h-5 w-5" />}
                        text="Faculties"
                        showingSidebar={showingSidebar}
                        className="text-white hover:bg-green-800"
                        activeClassName="bg-green-800"
                    />
                    <NavLink
                        icon={<UserCircle2 className="h-5 w-5" />}
                        text="Users"
                        showingSidebar={showingSidebar}
                        className="text-white hover:bg-green-800"
                        activeClassName="bg-green-800"
                    />
                    <NavLink
                        icon={<DoorOpen className="h-5 w-5" />}
                        text="Registration"
                        href="#"
                        showingSidebar={showingSidebar}
                        className="text-white hover:bg-green-800"
                        activeClassName="bg-green-800"
                        subItems={[
                            {
                                href: "/registration/form",
                                text: "Registration Form",
                                icon: <FormInputIcon className="h-4 w-4" />,
                            },
                            {
                                href: "/registration/list",
                                text: "Registration List",
                                icon: <ListIcon className="h-4 w-4" />,
                            },
                        ]}
                    />
                </div>
            </div>

            {/* Main Content */}
            <div className="flex-1 bg-gray-100">
                {/* Navigation Bar */}
                <nav className="bg-white shadow-sm">
                    <div className="mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex h-16 items-center justify-between">
                            {/* Mobile Menu Button */}
                            <div className="flex md:hidden">
                                <button
                                    onClick={() =>
                                        setMobileSidebarOpen(!mobileSidebarOpen)
                                    }
                                    className="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none"
                                >
                                    <Menu className="h-6 w-6" />
                                </button>
                            </div>

                            {/* Logo */}
                            <div className="flex items-center flex-1 justify-center md:justify-start">
                                <Link
                                    href="/"
                                    className="flex items-center md:ml-0"
                                >
                                    <ApplicationLogo className="h-10 w-auto fill-current text-green-600" />
                                    <span className="ml-3 text-xl font-bold text-gray-900 hidden md:block">
                                        {appName}
                                    </span>
                                </Link>
                            </div>

                            {/* Messages Dropdown */}
                            <div className="flex items-center space-x-4">
                                <div className="relative">
                                    <MessageCircle />
                                </div>
                            </div>

                            {/* Notification Dropdown */}
                            <div className="flex items-center space-x-4">
                                <div className="relative">
                                    <button className="p-2">
                                        <svg
                                            className="w-6 h-6 text-gray-700"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                strokeLinecap="round"
                                                strokeLinejoin="round"
                                                strokeWidth="2"
                                                d="M15 17h5l-1.405-1.405A2 2 0 0118 14V10a6 6 0 10-12 0v4a2 2 0 01-1.595 1.595L4 17h5m6 0v1a2 2 0 11-4 0v-1"
                                            />
                                        </svg>
                                        {/* You can add a badge if needed */}
                                        <span className="absolute top-0 right-0 rounded-full bg-red-600 text-white text-xs w-4 h-4 flex items-center justify-center">
                                            3
                                        </span>
                                    </button>
                                </div>
                            </div>
                            {/* Profile Dropdown */}
                            <div className="flex items-center space-x-4">
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <div className="flex items-center cursor-pointer">
                                            {/* Profile Icon */}
                                            <UserCircle2 />
                                        </div>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        <div className="px-4 py-3 border-b border-gray-100">
                                            <p className="text-sm text-gray-900">
                                                {user.name}
                                            </p>
                                            <p className="text-sm font-medium text-gray-500 truncate">
                                                {user.email}
                                            </p>
                                        </div>
                                        <Dropdown.Link
                                            href={route("profile.edit")}
                                        >
                                            Profile Settings
                                        </Dropdown.Link>
                                        <Dropdown.Link
                                            href={route("logout")}
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </Dropdown.Link>
                                    </Dropdown.Content>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </nav>

                {/* Main Content */}
                <main>
                    {header && (
                        <header className="bg-white shadow">
                            <div className="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                <h1 className="text-2xl font-bold text-gray-900">
                                    {header}
                                </h1>
                            </div>
                        </header>
                    )}

                    <div className="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8">
                        {children}
                    </div>
                </main>
            </div>
        </div>
    );
}
