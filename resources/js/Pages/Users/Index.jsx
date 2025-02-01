import { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, router } from "@inertiajs/react";
import {
    Table,
    Button,
    Modal,
    Input,
    Form,
    Space,
    Select,
    message,
    Upload,
} from "antd";
import {
    EditOutlined,
    DeleteOutlined,
    PlusOutlined,
    UploadOutlined,
} from "@ant-design/icons";
import TextInput from "@/Components/TextInput";

export default function Users() {
    const { users, roles } = usePage().props; // Fetch users and roles from Laravel
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [form] = Form.useForm();
    const [selectedUser, setSelectedUser] = useState(null);
    const [isEditing, setIsEditing] = useState(false);
    const [searchText, setSearchText] = useState(""); // State for search
    const [filteredUsers, setFilteredUsers] = useState(users); // Filtered users

    const [fileList, setFileList] = useState([]);

    const handleFileChange = ({ fileList: newFileList }) =>
        setFileList(newFileList);

    const normFile = (e) => {
        if (Array.isArray(e)) {
            return e;
        }
        return e?.fileList;
    };

    const showModal = (user = null) => {
        setIsEditing(!!user);
        setSelectedUser(user);

        if (user) {
            form.setFieldsValue({
                name: user.name,
                email: user.email,
                role: user.roles[0]?.id,
            });
        } else {
            form.resetFields();
        }
        setIsModalOpen(true);
    };

    const handleCancel = () => {
        setIsModalOpen(false);
        setSelectedUser(null);
    };

    const handleSave = async () => {
        try {
            const values = await form.validateFields();
            const payload = { ...values };

            // Add the profile picture if available
            if (fileList.length > 0) {
                payload.profile_picture = fileList[0].originFileObj; // Get the file object
            }

            if (isEditing) {
                // Update user
                router.put(`/users/${selectedUser.id}`, payload, {
                    onSuccess: () => {
                        message.success("User updated successfully");
                        router.get("/users"); // Refresh the users list
                    },
                });
            } else {
                // Create new user
                router.post("/users", payload, {
                    onSuccess: () => {
                        message.success("User created successfully");
                        router.get("/users"); // Refresh the users list
                    },
                });
            }

            setIsModalOpen(false);
        } catch (error) {
            console.log("Validation failed:", error);
        }
    };

    const handleDelete = (id) => {
        Modal.confirm({
            title: "Are you sure?",
            content: "This action cannot be undone.",
            okText: "Yes, Delete",
            okType: "danger",
            cancelText: "Cancel",
            onOk: () => {
                router.delete(`/users/${id}`, {
                    onSuccess: () => {
                        message.success("User deleted successfully");
                        // Re-fetch the users list to get the latest data
                        router.get("/users"); // Refresh the users list
                    },
                });
            },
        });
    };

    // Search functionality: Filter users by name or email
    const handleSearch = (value) => {
        setSearchText(value);
        const filtered = users.filter(
            (user) =>
                user.name.toLowerCase().includes(value.toLowerCase()) ||
                user.email.toLowerCase().includes(value.toLowerCase())
        );
        setFilteredUsers(filtered);
    };

    const columns = [
        {
            title: "Image",
            dataIndex: "profile_picture",
            key: "profile_picture",
            render: (text, record) => (
                <img
                    src={record.profile_picture || "/images/user.png"}
                    alt="Profile"
                    style={{ width: 50, height: 50, borderRadius: "50%" }}
                />
            ),
        },
        {
            title: "Name",
            dataIndex: "name",
            key: "name",
        },
        {
            title: "Email",
            dataIndex: "email",
            key: "email",
        },
        {
            title: "Email Verified?",
            dataIndex: "email_verified_at",
            key: "email_verified_at",
            render: (email_verified_at) => (
                <span>{email_verified_at ? "Yes" : "No"}</span>
            ),
        },
        {
            title: "Role",
            dataIndex: "roles",
            key: "roles",
            render: (roles) => roles.map((role) => role.name).join(", "), // Display roles in the table
        },
        {
            title: "Actions",
            key: "actions",
            render: (_, record) => (
                <Space>
                    <Button
                        type="primary"
                        icon={<EditOutlined />}
                        onClick={() => showModal(record)}
                    />
                    <Button
                        type="danger"
                        icon={<DeleteOutlined />}
                        onClick={() => handleDelete(record.id)}
                    />
                </Space>
            ),
        },
    ];

    return (
        <AuthenticatedLayout
            header={<h2 className="text-xl font-semibold">Users</h2>}
        >
            <Head title="Users" />
            <div className="py-12">
                <div className="mx-auto max-w-10xl sm:px-6 lg:px-8">
                    <div className="mb-4 flex justify-between">
                        <Input.Search
                            placeholder="Search by name or email"
                            allowClear
                            onChange={(e) => handleSearch(e.target.value)}
                            style={{ width: 300 }}
                        />
                        <Button
                            type="primary"
                            icon={<PlusOutlined />}
                            onClick={() => showModal()}
                        >
                            Add User
                        </Button>
                    </div>

                    <Table
                        columns={columns}
                        dataSource={filteredUsers}
                        rowKey="id"
                    />
                </div>
            </div>

            <Modal
                title={isEditing ? "Edit User" : "Add User"}
                open={isModalOpen}
                onCancel={handleCancel}
                onOk={handleSave}
            >
                <Form form={form} layout="vertical" encType="multipart/form-data">
                    <Form.Item
                        label="Name"
                        name="name"
                        rules={[{ required: true, message: "Please enter the user's name" }]}
                    >
                        <TextInput className="mt-1 block w-full" />
                    </Form.Item>

                    <Form.Item
                        label="Email"
                        name="email"
                        rules={[{ required: true, message: "Please enter the user's email" }]}
                    >
                        <TextInput className="mt-1 block w-full" />
                    </Form.Item>

                    <Form.Item
                        label="Password"
                        name="password"
                        rules={[
                            { required: !isEditing, message: "Please enter the user's password" },
                            { min: 6, message: "Password must be at least 6 characters" },
                        ]}
                    >
                        <TextInput type="password" className="mt-1 block w-full" />
                    </Form.Item>

                    <Form.Item
                        label="Select Role"
                        name="role"
                        rules={[{ required: true, message: "Please select a role" }]}
                    >
                        <Select>
                            {roles.map((role) => (
                                <Select.Option key={role.id} value={role.id}>
                                    {role.name}
                                </Select.Option>
                            ))}
                        </Select>
                    </Form.Item>

                    <Form.Item
                        label="Profile Picture"
                        name="profile_picture"
                        valuePropName="fileList"
                        getValueFromEvent={normFile}
                        extra="Upload a profile picture"
                    >
                        <Upload
                            name="profile_picture"
                            listType="picture"
                            beforeUpload={() => false} // Prevent automatic upload
                            accept="image/*"
                            fileList={fileList}
                            onChange={handleFileChange}
                        >
                            <Button icon={<UploadOutlined />}>Click to upload</Button>
                        </Upload>
                    </Form.Item>
                </Form>
            </Modal>
        </AuthenticatedLayout>
    );
}
