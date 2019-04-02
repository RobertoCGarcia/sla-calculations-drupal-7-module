<?php
require_once 'phplot/phplot.php';

date_default_timezone_set("America/Mexico_City");
$dateTime = " Last Update: " . date("h:i:sa");

# PHPlot Example: Using an X tick anchor to control grid lines
# This example is based on a question on the PHPlot forum on 5/8/2011.
# It requires PHPlot >= 5.4.0

# The first data point was recorded at this date/time: (always top of an hour)
# Example: 5/1/2011 at 10:00am
$year = 2019;
$month = 4;
$day = 01;
$hour = 24;
# Number of hourly data points, e.g. 168 for 1 week's worth:
$n_points = 160;
# ==================================================================
# Timestamp for the first data point:
$time0 = mktime($hour, 0, 0, $month, $day, $year); // H M S m d y
mt_srand(1); // For repeatable, identical results
# Build the PHPlot data array from the base data, and base timestamp.
$data = array();
$ts = $time0;
$tick_anchor = NULL;
$d = 2; // Data value

for ($i = 0; $i < $n_points; $i++) {
      # Decode this point's timestamp as hour 0-23:
      $hour = date('G', $ts);
      # Label noon data points with the weekday name, all others unlabelled.
      $label = ($hour == 12) ? strftime('%A', $ts) : '';
      # Remember the first midnight datapoint seen for use as X tick anchor:
      if (!isset($tick_anchor) && $hour == 0)
      $tick_anchor = $ts;
      # Make a random data point, and add a row to the data array:
      $d += mt_rand(-100, 150) / 100;
      //$data[] = array($label, $ts, $d);
      # Step to next hour:
      $ts += 3600;
}

//1554192000 8:00 AM
$data[] = array("Label 1", 1554192000, 10.58);
//1554199200 10:00 PM
$data[] = array("Label 2", 1554199200 , 15.58);
//1554210000 13:00 PM
$data[] = array("Label 3", 1554210000 , 25.58);
//$data[] = array("Label 4", 1554084333 , 850.58);
//$data[] = array("Label 5", 1554084333  , 950.58);
//$data[] = array("Label 6", 1554084333 , 1050.58);

$plot = new PHPlot(800, 600);
$plot->SetImageBorderType('plain'); // For presentation in the manual
$plot->SetTitle('Horas por hora');
$plot->SetDataType('data-data');
$plot->SetDataValues($data);
$plot->SetPlotType('lines');
# Make the X tick marks (and therefore X grid lines) 24 hours apart:
$plot->SetXTickIncrement(60 * 60 * 24);
$plot->SetDrawXGrid(True);
# Anchor the X tick marks at midnight. This makes the X grid lines act as
# separators between days of the week, regardless of the starting hour.
# (Except this messes up around daylight saving time changes.)
#PHPlot Examples
#192
$plot->SetXTickAnchor($tick_anchor);
# We want both X axis data labels and X tick labels displayed. They will
# be positioned in a way that prevents them from overwriting.
$plot->SetXDataLabelPos('plotdown');
$plot->SetXTickLabelPos('plotdown');
# Increase the left and right margins to leave room for weekday labels.
$plot->SetMarginsPixels(50, 50);
# Tick labels will be formatted as date/times, showing the date:
$plot->SetXLabelType('time', '%Y-%m-%d');
# ... but then we must reset the data label formatting to no formatting.
$plot->SetXDataLabelType('');
# Show tick labels (with dates) at 90 degrees, to fit between the data labels.
$plot->SetXLabelAngle(90);
# ... but then we must reset the data labels to 0 degrees.
$plot->SetXDataLabelAngle(0);
# Force the Y range to 0:100.
$plot->SetPlotAreaWorld(NULL, 0, NULL, 100);
# Now draw the graph:
$plot->DrawGraph();
