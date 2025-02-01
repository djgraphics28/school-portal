import { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, router } from "@inertiajs/react";
import { Table, Button, Modal, Input, Form, Space, message } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import TextInput from "@/Components/TextInput";

export default function Index() {
    const { courses } = usePage().props; // Fetch data from Laravel Inertia response

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isEditing, setIsEditing] = useState(false);
    const [form] = Form.useForm();
    const [selectedCourse, setSelectedCourse] = useState(null);
    const [searchText, setSearchText] = useState("");

    // Filter data based on search input
    const filteredCourses = courses.filter((course) =>
        course.name.toLowerCase().includes(searchText.toLowerCase())
    );

    // Open the modal for adding/editing
    const showModal = (course = null) => {
        setIsEditing(!!course);
        setSelectedCourse(course);
        if (course) {
            form.setFieldsValue(course);
        } else {
            form.resetFields();
        }
        setIsModalOpen(true);
    };

    // Close the modal
    const handleCancel = () => {
        setIsModalOpen(false);
        setSelectedCourse(null);
    };

    // Handle form submission
    const handleSave = async () => {
        try {
            const values = await form.validateFields();
            if (isEditing) {
                router.put(`/courses/${selectedCourse.id}`, values, {
                    onSuccess: () => message.success("Course updated successfully"),
                });
            } else {
                router.post("/courses", values, {
                    onSuccess: () => message.success("Course added successfully"),
                });
            }
            setIsModalOpen(false);
        } catch (error) {
            console.log("Validation failed:", error);
        }
    };

    // Delete course with confirmation
    const handleDelete = (id) => {
        Modal.confirm({
            title: "Are you sure?",
            content: "This action cannot be undone.",
            okText: "Yes, Delete",
            okType: "danger",
            cancelText: "Cancel",
            onOk: () => {
                router.delete(`/courses/${id}`, {
                    onSuccess: () => message.success("Course deleted successfully"),
                });
            },
        });
    };

    // Table columns
    const columns = [
        {
            title: "Course Name",
            dataIndex: "name",
            key: "name",
        },
        {
            title: "Description",
            dataIndex: "description",
            key: "description",
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
                    Courses
                </h2>
            }
        >
            <Head title="Courses" />
            <div className="py-12">
                <div className="mx-auto max-w-10xl sm:px-6 lg:px-8">
                    <div className="mb-4 flex justify-between">
                        <Input.Search
                            placeholder="Search by course name"
                            allowClear
                            onChange={(e) => setSearchText(e.target.value)}
                            style={{ width: 300 }}
                        />
                        <Button type="primary" icon={<PlusOutlined />} onClick={() => showModal()}>
                            Add Course
                        </Button>
                    </div>

                    <Table columns={columns} dataSource={filteredCourses} rowKey="id" />
                </div>
            </div>

            {/* Add/Edit Modal */}
            <Modal
                title={isEditing ? "Edit Course" : "Add Course"}
                open={isModalOpen}
                onCancel={handleCancel}
                onOk={handleSave}
            >
                <Form form={form} layout="vertical">
                    <Form.Item
                        label="Course Name"
                        name="name"
                        rules={[{ required: true, message: "Please enter course name" }]}
                    >
                        <TextInput className="mt-1 block w-full" />
                    </Form.Item>
                    <Form.Item
                        label="Description"
                        name="description"
                        rules={[{ required: true, message: "Please enter course description" }]}
                    >
                        <Input.TextArea />
                    </Form.Item>
                </Form>
            </Modal>
        </AuthenticatedLayout>
    );
}
