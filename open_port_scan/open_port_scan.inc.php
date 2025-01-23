<?php
//
// Open Port Scan Config Wizard
//
include_once(dirname(__FILE__) . '/../configwizardhelper.inc.php');

open_port_scan_configwizard_init();

function open_port_scan_configwizard_init()
{
    $name = "open_port_scan";
    $args = array(
        CONFIGWIZARD_NAME => $name,
        CONFIGWIZARD_VERSION => "1.0.0",
        CONFIGWIZARD_TYPE => CONFIGWIZARD_TYPE_MONITORING,
        CONFIGWIZARD_DESCRIPTION => _( "Scans for open ports on a specified IP address." ),
        CONFIGWIZARD_DISPLAYTITLE => "Open Port Scan",
        CONFIGWIZARD_FUNCTION => "open_port_scan_configwizard_func",
        CONFIGWIZARD_PREVIEWIMAGE => "open_port_scan.png",
        CONFIGWIZARD_FILTER_GROUPS => array('network', 'security'),
        CONFIGWIZARD_REQUIRES_VERSION => 60100
    );
    register_configwizard($name, $args);
}

function open_port_scan_configwizard_func($mode, $inargs, &$outargs, &$result)
{
    switch ($mode) {
        case CONFIGWIZARD_MODE_GETSTAGE1HTML:
            return "<p>Enter the IP address you want to scan for open ports.</p>";
        case CONFIGWIZARD_MODE_VALIDATESTAGE1DATA:
            return true;
        case CONFIGWIZARD_MODE_GETFINALSTAGEHTML:
            return "<p>Confirm and deploy the port scan check.</p>";
        case CONFIGWIZARD_MODE_GETOBJECTS:
            $host = grab_array_var($inargs, "host");
            $services = array(
                array(
                    "name" => "Open Port Scan",
                    "check_command" => "check_open_ports!$host"
                )
            );
            return array("hosts" => array($host), "services" => $services);
    }
}
