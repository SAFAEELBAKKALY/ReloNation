document.addEventListener('DOMContentLoaded', function() {
    
    const statusElement = document.querySelector("#status");
    const clientId = statusElement.getAttribute('value');

    fetchRequestStatus(clientId);
});

document.getElementById('logoutButton').addEventListener('click', function() {
    logout();
});

function fetchRequestStatus(clientId) {
    const fakeData = {
        'client123': {
            status: 'In Progress', // Example status for client123
            assistanceNumber: '+1 (234) 567-890' // Example assistance number for client123
        },
        'client456': {
            status: 'Done', // Example status for client456
            assistanceNumber: '+1 (345) 678-9012' // Example assistance number for client456
        },
        'client789': {
            status: 'Not Yet', // Example status for client456
            assistanceNumber: '+1 (345) 678-9012' // Example assistance number for client456
        },
        // Add more clients as needed
    };

    const clientData = fakeData[clientId];
    if (clientData) {
        const statusEmoji = getStatusEmoji(clientData.status);
        document.getElementById('status').innerHTML = `Status: ${statusEmoji}`;
        document.querySelector('a').setAttribute('href', `tel:${clientData.assistanceNumber}`);
        document.querySelector('a').textContent = clientData.assistanceNumber;
    } else {
        document.getElementById('status').textContent = 'Request not found';
        document.querySelector('a').textContent = 'Assistance number not available';
    }
}

function getStatusEmoji(status) {
    switch (status) {
        case 'In Progress':
            return '⌛';
        case 'Done':
            return '✔️';
        case 'Not Yet':
            return '❌';
        default:
            return '❓';
    }
}

function logout() {
    Swal.fire({
        title: 'Log Out',
        text: 'Are you sure you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FA9E15',
        cancelButtonColor: '#6C757D',
        confirmButtonText: 'Log Out',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Logged Out',
                text: 'You have been logged out successfully.',
                icon: 'success',
                confirmButtonColor: '#00A19D',
                timer: 3000, // Display for 3 seconds
                timerProgressBar: true
            });

            // Perform logout actions here
            // Simulate logging out
            setTimeout(() => {
                window.location.href = '../php/logout.php'; // Change the URL as per your requirement
            }, 3500); // Redirect after 3.5 seconds
        }
    });
}
