import { Link } from "@inertiajs/react";
import { useState } from "react";

export default function NavLink({
    active = false,
    text = "Link",
    showingSidebar = true,
    className = "",
    children,
    icon,
    subItems = [],
    ...props
}) {
    const [isSubMenuOpen, setIsSubMenuOpen] = useState(false);

    const toggleSubMenu = (e) => {
        if (subItems.length > 0) {
            e.preventDefault(); // Prevent navigation if there's a submenu
            setIsSubMenuOpen(!isSubMenuOpen);
        }
    };

    return (
        <div>
            <Link title={text}
                {...props}
                className={`block w-full px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none ${
                    active
                        ? "border-l-4 border-indigo-400 bg-green-800 text-white"
                        : "border-l-4 border-transparent text-white-700 hover:border-green-400 hover:bg-green-800 hover:text-white-900"
                } ${className}`}
                onClick={toggleSubMenu}
            >
                <div className="flex space-x-2 ">
                    {icon && <span>{icon}</span>}

                    <span
                        className={`transform${
                            showingSidebar
                                ? "opacity-100 translate-x-0"
                                : "opacity-0 translate-x-4"
                        } transition-all duration-300`}
                    >
                        {showingSidebar ? text : ""}
                    </span>

                    {subItems.length > 0 && (
                        <span className="ml-auto flex items-center">
                            <svg
                                className={`w-4 h-4 transform transition-transform ${
                                    isSubMenuOpen ? "rotate-180" : ""
                                }`}
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

            {subItems.length > 0 && isSubMenuOpen && (
                <div className="pl-1 border-l border-green-300">
                    {subItems.map((item, index) => (
                        <NavLink
                            key={index}
                            {...item}
                            showingSidebar={showingSidebar}
                            className="text-white-600 hover:text-white-900"
                        />
                    ))}
                </div>
            )}
        </div>
    );
}
