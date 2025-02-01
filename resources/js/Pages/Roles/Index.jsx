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
    message,
    Checkbox,
} from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import TextInput from "@/Components/TextInput";

export default function Roles() {
    const { roles, permissions } = usePage().props; // Fetch roles & permissions from Laravel
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [form] = Form.useForm();
    const [selectedRole, setSelectedRole] = useState(null);
    const [selectedPermissions, setSelectedPermissions] = useState([]);
    const [isEditing, setIsEditing] = useState(false);
    const [searchQuery, setSearchQuery] = useState(""); // For search query

    const showModal = (role = null) => {
        setIsEditing(!!role);
        setSelectedRole(role);
        if (role) {
            form.setFieldsValue({ name: role.name });
        } else {
            form.resetFields();
        }
        setSelectedPermissions(role ? role.permissions.map((p) => p.name) : []);
        setIsModalOpen(true);
    };

    const handleCancel = () => {
        setIsModalOpen(false);
        setSelectedRole(null);
    };

    const handleSave = async () => {
        try {
            const values = await form.validateFields();
            const payload = { ...values, permissions: selectedPermissions };

            if (isEditing) {
                router.put(`/roles/${selectedRole.id}`, payload, {
                    onSuccess: () =>
                        message.success("Role updated successfully"),
                });
            } else {
                router.post("/roles", payload, {
                    onSuccess: () => message.success("Role added successfully"),
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
                router.delete(`/roles/${id}`, {
                    onSuccess: () =>
                        message.success("Role deleted successfully"),
                });
            },
        });
    };

    const handlePermissionChange = (checkedValues) => {
        setSelectedPermissions(checkedValues);
    };

    const handleSearch = (e) => {
        setSearchQuery(e.target.value);
    };

    const filteredRoles = roles.filter(
        (role) => role.name.toLowerCase().includes(searchQuery.toLowerCase()) // Filter by role name
    );

    const columns = [
        {
            title: "Role Name",
            dataIndex: "name",
            key: "name",
        },
        {
            title: "Permissions",
            dataIndex: "permissions",
            key: "permissions",
            render: (perms) => perms.map((p) => p.name).join(", "), // Show permissions in table
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
            header={<h2 className="text-xl font-semibold">Roles</h2>}
        >
            <Head title="Roles" />
            <div className="py-12">
                <div className="mx-auto max-w-10xl sm:px-6 lg:px-8">
                    <div className="mb-4 flex justify-between items-center">
                        <Input.Search
                            placeholder="Search by role"
                            allowClear
                            onChange={handleSearch}
                            style={{ width: 300 }}
                        />
                        <Button
                            type="primary"
                            icon={<PlusOutlined />}
                            onClick={() => showModal()}
                        >
                            Add Role
                        </Button>
                    </div>

                    {/* Display filtered roles in the table */}
                    <Table
                        columns={columns}
                        dataSource={filteredRoles}
                        rowKey="id"
                    />
                </div>
            </div>

            <Modal
                title={isEditing ? "Edit Role" : "Add Role"}
                open={isModalOpen}
                onCancel={handleCancel}
                onOk={handleSave}
            >
                <Form form={form} layout="vertical">
                    <Form.Item
                        label="Role Name"
                        name="name"
                        rules={[
                            {
                                required: true,
                                message: "Please enter role name",
                            },
                        ]}
                    >
                        <TextInput className="mt-1 block w-full" />
                    </Form.Item>

                    <Form.Item label="Select Permissions">
                        <Checkbox.Group
                            options={permissions.map((perm) => ({
                                label: perm.name,
                                value: perm.name,
                            }))}
                            value={selectedPermissions}
                            onChange={handlePermissionChange}
                        />
                    </Form.Item>
                </Form>
            </Modal>
        </AuthenticatedLayout>
    );
}
