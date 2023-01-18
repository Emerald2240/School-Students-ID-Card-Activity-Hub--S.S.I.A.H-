<?php
$myMachine = getStaffsMachine($_SESSION['staff_id']);
$activeJobId = $myMachine['active_job_id'];
$activeJobInfo = getJobFromId($activeJobId);

$jobStatsAndDates = divideJobEntriesIntoCountsPerDay($activeJobId)

?>
<script>
    if (typeof jQuery === "undefined") {
        throw new Error("jQuery plugins need to be before this file");
    }
    $(function() {
        "use strict";
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Employees Data
        $(document).ready(function() {
            var options = {
                align: 'center',
                chart: {
                    height: 250,
                    type: 'donut',
                    align: 'center',
                },
                labels: ['Male', 'Female'],
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    show: true,
                },
                colors: ['var(--chart-color4)', 'var(--chart-color3)'],

                series: [<?= getGenderCount(getAllStudentsScannedPerJobId($activeJobId), 'Male') ?>, <?= getGenderCount(getAllStudentsScannedPerJobId($activeJobId), 'Female') ?>],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }
            var chart = new ApexCharts(document.querySelector("#apex-MainCategories"), options);
            chart.render();
        });

    });
</script>