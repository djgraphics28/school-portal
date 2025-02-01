import { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, router } from "@inertiajs/react";
import { Table, Button, Modal, Input, Form, Space, message } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import TextInput from "@/Components/TextInput";

export default function Index() {
    const { subjects } = usePage().props; // Fetch subjects from Laravel Inertia response

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isEditing, setIsEditing] = useState(false);
    const [form] = Form.useForm();
    const [selectedSubject, setSelectedSubject] = useState(null);
    const [searchText, setSearchText] = useState("");

    // Filter subjects based on search input
    const filteredSubjects = subjects.filter((subject) =>
        subject.name.toLowerCase().includes(searchText.toLowerCase())
    );

    // Open the modal for adding/editing
    const showModal = (subject = null) => {
        setIsEditing(!!subject);
        setSelectedSubject(subject);
        if (subject) {
            form.setFieldsValue(subject);
        } else {
            form.resetFields();
        }
        setIsModalOpen(true);
    };

    // Close the modal
    const handleCancel = () => {
        setIsModalOpen(false);
        setSelectedSubject(null);
    };

    // Handle form submission
    const handleSave = async () => {
        try {
            const values = await form.validateFields();
            if (isEditing) {
                router.put(`/subjects/${selectedSubject.id}`, values, {
                    onSuccess: () => message.success("Subject updated successfully"),
                });
            } else {
                router.post("/subjects", values, {
                    onSuccess: () => message.success("Subject added successfully"),
                });
            }
            setIsModalOpen(false);
        } catch (error) {
            console.log("Validation failed:", error);
        }
    };

    // Delete subject with confirmation
    const handleDelete = (id) => {
        Modal.confirm({
            title: "Are you sure?",
            content: "This action cannot be undone.",
            okText: "Yes, Delete",
            okType: "danger",
            cancelText: "Cancel",
            onOk: () => {
                router.delete(`/subjects/${id}`, {
                    onSuccess: () => message.success("Subject deleted successfully"),
                });
            },
        });
    };

    // Table columns
    const columns = [
        {
            title: "Name",
            dataIndex: "name",
            key: "name",
        },
        {
            title: "Code",
            dataIndex: "code",
            key: "code",
        },
        {
            title: "Units",
            dataIndex: "units",
            key: "units",
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
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Subjects
                </h2>
            }
        >
            <Head title="Subjects" />
            <div className="py-12">
                <div className="mx-auto max-w-10xl sm:px-6 lg:px-8">
                    <div className="mb-4 flex justify-between">
                        <Input.Search
                            placeholder="Search by name"
                            allowClear
                            onChange={(e) => setSearchText(e.target.value)}
                            style={{ width: 300 }}
                        />
                        <Button type="primary" icon={<PlusOutlined />} onClick={() => showModal()}>
                            Add Subject
                        </Button>
                    </div>

                    <Table columns={columns} dataSource={filteredSubjects} rowKey="id" />
                </div>
            </div>

            {/* Add/Edit Modal */}
            <Modal
                title={isEditing ? "Edit Subject" : "Add Subject"}
                open={isModalOpen}
                onCancel={handleCancel}
                onOk={handleSave}
            >
                <Form form={form} layout="vertical">
                    <Form.Item
                        label="Name"
                        name="name"
                        rules={[{ required: true, message: "Please enter subject name" }]}
                    >
                        <TextInput className="mt-1 block w-full" />
                    </Form.Item>
                    <Form.Item
                        label="Code"
                        name="code"
                        rules={[{ required: true, message: "Please enter subject code" }]}
                    >
                        <TextInput className="mt-1 block w-full" />
                    </Form.Item>
                    <Form.Item
                        label="Units"
                        name="units"
                        rules={[{ required: true, message: "Please enter number of units" }]}
                    >
                        <TextInput className="mt-1 block w-full" type="number" />
                    </Form.Item>
                    <Form.Item label="Description" name="description">
                        <Input.TextArea />
                    </Form.Item>
                </Form>
            </Modal>
        </AuthenticatedLayout>
    );
}
