<?php

use App\Enums\ApproveStatusEnum;

return [
    'input' => [
        'placeholder' => 'กรอกข้อมูล'
    ],

    'status' => 'สถานะ',
    'status_' . STATUS_ACTIVE => 'ใช้งาน',
    'status_' . STATUS_INACTIVE => 'ระงับ',
    'status_' . STATUS_DEFAULT => 'ระงับ',

    'status_class_' . STATUS_ACTIVE => 'success',
    'status_class_' . STATUS_INACTIVE => 'secondary',
    'status_class_' . STATUS_DEFAULT => 'secondary',

    'job_type_rental' => 'เช่าสั้น',
    'job_type_lt_rental' => 'เช่ายาว',

    'seq' => 'ลำดับ',
    'created_at' => 'วันที่สร้าง',
    'updated_at' => 'แก้ไขล่าสุด',
    'linked_at' => 'เชื่อมโยงเมื่อ',
    'created_by' => 'สร้างโดย',
    'updated_by' => 'ผู้แก้ไขล่าสุด',
    'linked_by' => 'เชื่อมโยงโดย',
    'ok' => 'ตกลง',
    'store_success_title' => 'สำเร็จ',
    'store_success_message' => 'บันทึกข้อมูลเรียบร้อย',
    'store_error_title' => 'เกิดข้อผิดพลาด',
    'manage' => 'จัดการ',
    'add_new' => 'สร้าง',
    'search_label' => 'คำค้นหา',
    'search_placeholder' => 'ระบุคำที่ต้องการ',
    'search' => 'ค้นหา',
    'select' => 'ค้นหา',
    'input_search' => 'ใส่คำค้นหา',
    'clear_search' => 'ล้างค่า',
    'tools' => 'เครื่องมือ',
    'edit' => 'แก้ไข',
    'create' => 'เพิ่ม',
    'delete' => 'ลบ',
    'save' => 'บันทึก',
    'save_draft' => 'บันทึกแบบร่าง',
    'edit_draft' => 'แก้ไขร่าง',
    'save_send' => 'ส่งข้อมูล',
    'back' => 'กลับ',
    'cancel' => 'ยกเลิก',
    'confirm' => 'ยืนยัน',
    'previous' => 'ก่อนหน้า',
    'next' => 'ถัดไป',
    'delete_data' => 'ยืนยันลบข้อมูล',
    'delete_message_confirm' => 'ต้องการลบข้อมูลใช่หรือไม่ ?',
    'delete_success' => 'เรียบร้อย',
    'delete_fail' => 'ไม่สามารถลบข้อมูลได้',
    'deleted_message' => 'ลบข้อมูลเรียบร้อย',
    'select_option' => '- กรุณาเลือก -',
    'select_required' => 'กรุณาเลือก',
    'field_required' => 'กรุณากรอก',
    'no_list' => 'ไม่มีรายการ',
    'required_field_inform' => 'กรุณากรอกข้อมูลให้ครบถ้วน',
    'add' => 'เพิ่ม',
    'add_data' => 'เพิ่มข้อมูล',
    'edit_data' => 'เพิ่มข้อมูล',
    'export_btn' => 'ส่งออกข้อมูล',
    'view' => 'ดู',
    'remark' => 'หมายเหตุ',
    'select_date' => 'เลือกวัน',
    'select_time' => 'เลือกเวลา',
    'sum' => 'รวม',
    'total' => 'ทั้งหมด',
    'reason' => 'เหตุผล',
    'close_job' => 'ยืนยันการปิดงาน',
    'close_job_message_confirm' => 'ต้องการปิดงานใช่หรือไม่ ?',
    'approve' => 'อนุมัติ',
    'disapprove' => 'ไม่อนุมัติ',
    'no_data' => 'ไม่มีข้อมูล',
    'total_list' => 'รายการทั้งหมด',
    'yes' => 'ใช่',
    'no' => 'ไม่ใช่',
    'choice_1' => 'ใช่',
    'choice_0' => 'ไม่ใช่',
    'not_found' => 'ไม่พบข้อมูล',
    'file' => 'ไฟล์',
    'cancel_success' => 'ยกเลิกเรียบร้อย',
    'cancel_confirm' => 'ยืนยันการยกเลิก',
    'cancel_fail' => 'ไม่สามารถยกเลิกข้อมูลได้',
    'view_file' => 'ดูตัวอย่างไฟล์',
    'update_confirm' => 'ยืนยันการเปลี่ยนสถานะ',
    'update_confirm_question' => 'ต้องการเปลี่ยนสถานะใช่หรือไม่ ?',
    'no_attach_file' => 'ไม่มีไฟล์แนบ',
    'have' => 'มี',
    'no_have' => 'ไม่มี',
    'download' => 'ดาวน์โหลด',
    'config_approve_warning' => 'กรุณาตั้งค่าการอนุมัติ',
    'wanted' => 'ต้องการ',
    'unwanted' => 'ไม่ต้องการ',
    'require_province' => 'กรุณาเลือกจังหวัด',
    'list' => 'รายการ',
    'btn_mail' => 'ส่งอีเมล',

    // transaction
    'full_name' => 'ชื่อ-นามสกุล',
    'role_name' => 'บทบาท',
    'branch_name' => 'สาขา',
    'action' => 'การดำเนินการ',
    'datetime' => 'วันและเวลา',

    'status_' . ApproveStatusEnum::PENDING_REVIEW => 'รออนุมัติ',
    'class_' . ApproveStatusEnum::PENDING_REVIEW => 'warning',
    'status_' . ApproveStatusEnum::CONFIRM => 'อนุมัติ',
    'class_' . ApproveStatusEnum::CONFIRM => 'success',
    'status_' . ApproveStatusEnum::REJECT => 'ไม่อนุมัติ',
    'class_' . ApproveStatusEnum::REJECT => 'danger',
    'year' => 'ปี',
    'baht' => 'บาท',
    'order' => 'ลำดับที่',
    'month' => 'เดือน',
    'only_number' => 'ต้องเป็นตัวเลขเท่านั้น',
    'total_items' => 'ข้อมูลทั้งหมด',
    'is_valid' => 'ข้อมูลถูกต้อง',
    'date' => 'Y-m-d',

    'creator' => [
        'creator' => 'ผู้จัดทำใบงาน',
        'role' => 'บทบาท',
        'created_at' => 'วันที่จัดทำ',
        'branch' => 'สาขา',
    ]
];
