<?php
// Include Nagios XI environment
require_once(dirname(__FILE__).'/../includes/common.inc.php');

function get_nagios_data() {
    $url = "http://localhost/nagiosxi/api/v1/objects/hosts";
    $api_key = "YOUR_API_KEY";  // Replace with actual Nagios API Key

    $options = array(
        "http" => array(
            "header" => "Authorization: Bearer " . $api_key,
            "method" => "GET"
        )
    );

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    if ($response === FALSE) {
        return [];
    }

    return json_decode($response, true);
}

// AI Model Integration
function get_risk_score($host_name) {
    $command = escapeshellcmd("python3 predict_risk.py $host_name");
    $output = shell_exec($command);
    return intval($output);
}

$data = get_nagios_data();
?>

<div class="ai_dashlet">
    <h3>AI-Powered Host Risk Score</h3>
    <table>
        <tr><th>Host</th><th>Status</th><th>Risk Score</th></tr>
        <?php if (!empty($data['hosts'])): ?>
            <?php foreach ($data['hosts'] as $host): ?>
                <tr>
                    <td><?php echo $host['host_name']; ?></td>
                    <td class="<?php echo strtolower($host['current_state']) == '0' ? 'ok' : 'critical'; ?>">
                        <?php echo $host['current_state'] == '0' ? 'UP' : 'DOWN'; ?>
                    </td>
                    <td><?php echo get_risk_score($host['host_name']); ?>%</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3" style="text-align:center; color:red;">No Data Available</td></tr>
        <?php endif; ?>
    </table>
</div>
