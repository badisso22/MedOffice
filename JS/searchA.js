function openArchiveModal(assistantId, assistantName, assistantAge) {
    document.getElementById('modalAssistantId').textContent = assistantId;
    document.getElementById('modalAssistantName').textContent = assistantName;
    document.getElementById('modalAssistantAge').textContent = assistantAge;
    document.getElementById('archiveModal').classList.add('active');
}

function closeArchiveModal() {
    document.getElementById('archiveModal').classList.remove('active');
}

function confirmArchive() {
    const assistantId = document.getElementById('modalAssistantId').textContent;
    const assistantName = document.getElementById('modalAssistantName').textContent;
    const assistantAge = document.getElementById('modalAssistantAge').textContent;
    closeArchiveModal();
    
    document.getElementById('successAssistantId').textContent = assistantId;
    document.getElementById('successAssistantName').textContent = assistantName;
    document.getElementById('successAssistantAge').textContent = assistantAge;
    document.getElementById('successModal').classList.add('active');
}

function closeSuccessModal() {
    document.getElementById('successModal').classList.remove('active');
}
document.getElementById('archiveModal').addEventListener('click', function(e) {
    if (e.target === this) {
    closeArchiveModal();
    }
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
    closeArchiveModal();
    closeSuccessModal();
    }
});
document.getElementById('successModal').addEventListener('click', function(e) {
    if (e.target === this) {
    closeSuccessModal();
    }
});