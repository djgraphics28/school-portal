import { Link } from '@inertiajs/react';
import { useState } from 'react';

export default function NavLink({
    active = false,
    text = 'Link',
    showingSidebar = true,
    className = '',
    children,
    icon,
    subItems = [], // Add subItems prop for submenu
    ...props
}) {
    const [isSubMenuOpen, setIsSubMenuOpen] = useState(false);

    const toggleSubMenu = () => {
        setIsSubMenuOpen(!isSubMenuOpen);
    };

    return (
        <div>
            <Link
                {...props}
                className={
                    'block w-full px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none ' +
                    (active
                        ? 'border-l-4 border-indigo-400 bg-green-800 text-gray-900'
                        : 'border-l-4 border-transparent text-gray-500 hover:border-indigo-400 hover:bg-white-50 hover:text-white-700') +
                    ' ' +
                    className
                }
                onClick={subItems.length > 0 ? toggleSubMenu : undefined} // Toggle submenu on click
            >
                <div className="flex items-center space-x-2">
                    {icon && <span>{icon}</span>}

                    {/* Text with transition effect */}
                    <span
                        className={`transform ${showingSidebar ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-4'} transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0`}
                    >
                        {showingSidebar ? text : ''}
                    </span>

                    {/* Add a chevron icon if submenu exists */}
                    {subItems.length > 0 && (
                        <span className="ml-auto">
                            <svg
                                className={`w-4 h-4 transform transition-transform ${isSubMenuOpen ? 'rotate-180' : ''}`}
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </span>
                    )}
                </div>
            </Link>

            {/* Render submenu items if they exist */}
            {subItems.length > 0 && isSubMenuOpen && (
                <div className="pl-4">
                    {subItems.map((item, index) => (
                        <NavLink
                            key={index}
                            {...item}
                            showingSidebar={showingSidebar}
                        />
                    ))}
                </div>
            )}
        </div>
    );
}
