// orderStatusUpdate.js

function updateOrderStatus(statusId, orderId, redirectUrl) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response.success) {
                document.getElementById('sessionMessage').innerHTML = "<div class='alert alert-success'>" + response.message + "</div>";
                // Refresh the page after 1 second
                setTimeout(function() {
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    } else {
                        location.reload();
                    }
                }, 1000);
            } else {
                document.getElementById('sessionMessage').innerHTML = "<div class='alert alert-danger'>" + response.message + "</div>";
            }
        }
    };
    
    xhttp.open("POST", "updateOrderStatus.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data = "statusId=" + encodeURIComponent(statusId) + "&orderId=" + encodeURIComponent(orderId);
    xhttp.send(data);
}
