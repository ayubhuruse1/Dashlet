// AI-Powered Nagios XI Dashlet - Real-Time Updates & Dynamic UI

$(document).ready(function() {
    function updateDashlet() {
        $(".ai_dashlet").addClass("loading"); // Add loading effect
        $.ajax({
            url: "dashlet.php",
            method: "GET",
            success: function(data) {
                $(".ai_dashlet").html(data);
            },
            error: function(error) {
                console.error("Error updating AI Dashlet:", error);
                $(".ai_dashlet").html("<p class='error-message'>Error fetching data. Please check Nagios API.</p>");
            },
            complete: function() {
                $(".ai_dashlet").removeClass("loading");
            }
        });
    }

    // Auto-refresh every 10 seconds
    setInterval(updateDashlet, 10000);
});

// Dark Mode Toggle
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
}

// AI Risk Score UI Enhancements
function renderRiskScore(score) {
    let color = score > 75 ? "red" : score > 50 ? "orange" : "green";
    return `<span style='color:${color}; font-weight:bold;'>${score}%</span>`;
}
