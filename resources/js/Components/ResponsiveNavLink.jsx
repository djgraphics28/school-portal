import { Link } from '@inertiajs/react';

export default function ResponsiveNavLink({
    active = false,
    text = 'Link',
    showingSidebar = true,
    className = '',
    children,
    icon,
    ...props
}) {
    return (
        <Link
            {...props}
            className={`flex w-full items-center border-l-4 py-2 pe-4 ps-3 ${
                active
                    ? 'border-indigo-400 bg-indigo-50 text-indigo-700 focus:border-indigo-700 focus:bg-indigo-100 focus:text-indigo-800'
                    : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 focus:border-gray-300 focus:bg-gray-50 focus:text-gray-800'
            } text-base font-medium transition duration-150 ease-in-out focus:outline-none ${className}`}
        >
            {/* Icon and text with transition effects */}
            <div className="flex items-center space-x-2">
                {icon && <span>{icon}</span>}

                {/* Text with transition effect */}
                <span
                    className={`transform ${showingSidebar ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-4'} transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0`}
                >
                    {showingSidebar || text}
                </span>
            </div>

            {children}
        </Link>
    );
}
