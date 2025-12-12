function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
}
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.querySelector('.menu-toggle');
    
    if (window.innerWidth <= 1024 && sidebar && sidebar.classList.contains('active')) {
        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    }
});
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        window.location.href = '../index.html';
    }
}
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}
window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
});
function addUser() {
    openModal('addUserModal');
}

function editUser(userId) {
    openModal('editUserModal');
    console.log('Edit user:', userId);
}

function deleteUser(userId, userName) {
    if (confirm(`Are you sure you want to delete user "${userName}"?`)) {
        console.log('Delete user:', userId);
        alert('User deleted successfully!');
    }
}

function submitAddUser(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('Add user:', Object.fromEntries(formData));
    closeModal('addUserModal');
    alert('User added successfully!');
    event.target.reset();
}

function submitEditUser(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('[v0] Edit user:', Object.fromEntries(formData));
    closeModal('editUserModal');
    alert('User updated successfully!');
}
function addCabinet() {
    openModal('addCabinetModal');
}

function editCabinet(cabinetId) {
    openModal('editCabinetModal');
    console.log('Edit cabinet:', cabinetId);
}

function suspendCabinet(cabinetId, cabinetName) {
    if (confirm(`Are you sure you want to suspend cabinet "${cabinetName}"?`)) {
        console.log('Suspend cabinet:', cabinetId);
        alert('Cabinet suspended successfully!');
    }
}

function archiveCabinet(cabinetId, cabinetName) {
    if (confirm(`Are you sure you want to archive cabinet "${cabinetName}"?`)) {
        console.log('Archive cabinet:', cabinetId);
        alert('Cabinet archived successfully!');
    }
}

function deleteCabinet(cabinetId, cabinetName) {
    if (confirm(`Are you sure you want to delete cabinet "${cabinetName}"?`)) {
        console.log('Delete cabinet:', cabinetId);
        alert('Cabinet deleted successfully!');
    }
}

function submitAddCabinet(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('Add cabinet:', Object.fromEntries(formData));
    closeModal('addCabinetModal');
    alert('Cabinet added successfully!');
    event.target.reset();
}

function submitEditCabinet(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log('Edit cabinet:', Object.fromEntries(formData));
    closeModal('editCabinetModal');
    alert('Cabinet updated successfully!');
}

function markAsRead(notificationId) {
    const notification = document.querySelector(`[data-notification-id="${notificationId}"]`);
    if (notification) {
        notification.classList.remove('unread');
        console.log('Mark notification as read:', notificationId);
    }
}

function markAllAsRead() {
    const notifications = document.querySelectorAll('.notification-item.unread');
    notifications.forEach(notification => {
        notification.classList.remove('unread');
    });
    console.log('[v0] Mark all notifications as read');
    alert('All notifications marked as read!');
}

function deleteNotification(notificationId) {
    if (confirm('Are you sure you want to delete this notification?')) {
        const notification = document.querySelector(`[data-notification-id="${notificationId}"]`);
        if (notification) {
            notification.remove();
            console.log('Delete notification:', notificationId);
        }
    }
}
function saveSettings() {
    console.log('Save settings');
    alert('Settings saved successfully!');
}
document.addEventListener('DOMContentLoaded', function() {
    console.log('Superadmin dashboard initialized');
});
