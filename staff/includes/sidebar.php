<div id="mainHeader" class="sidebar px-4 py-4 py-md-5 me-0">
    <div class="d-flex flex-column h-100">
        <a href="index" class="mb-0 brand-icon">
            <span class="logo-icon">
                <svg width="35" height="35" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                </svg>
            </span>
            <?php
            $myMachine = getStaffsMachine($_SESSION['staff_id']);
            $activeTask = getActiveTaskForStaff($_SESSION['staff_id']);
            if(!$activeTask){

            }else{
                $activeJobId = $activeTask['id'];
            }
            ?>
            <?php if (checkIfActiveMachineJobBelongsToStaff($_SESSION['staff_id'])) { ?>
                <?php if ($activeTask) { ?>
                    <span class="logo-text"><?= shortenText($activeTask['name'], 25) ?> | <?= formatDateFriendlier($activeTask['date_updated']) ?></span>
                <?php }
            } else { ?>
                <!-- <span class="logo-text">Previous Owner Job Active</span> -->
                <span class="logo-text">No Job Active</span>
            <?php } ?>
        </a>
        <!-- Menu: main ul -->

        <ul class="menu-list flex-grow-1 mt-3">
            <li class="collapsed">
                <!-- active can be added here -->
                <a class="m-link " data-bs-toggle="collapse" data-bs-target="#dashboard-Components" href="#">
                    <i class="icofont-home fs-5"></i> <span>Dashboard</span>
                    <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
                </a>
                <!-- Menu: Sub menu ul -->
                <ul class="collapse" id="dashboard-Components">
                    <!-- active can be added here -->
                    <li><a class="ms-link" href="index"> <span>Summary</span></a></li>
                    <!-- <li><a class="ms-link" onclick="showAlert('Coming Soon', 'Feature still in construction')"> <span>Data Visualisation</span></a></li> -->
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#project-Components" href="#">
                    <i class="icofont-briefcase"></i><span>Jobs</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="project-Components">
                    <li><a class="ms-link" href="jobs"><span>All Jobs</span></a></li>
                    <!-- <li><a class="ms-link" href="new-job"><span>Create New Job</span></a></li> -->
                </ul>
            </li>

            <?php if ($myMachine) { ?>
                <?php if (checkIfActiveMachineJobBelongsToStaff($_SESSION['staff_id'])) { ?>
                    <?php if(!$activeJobId){}else{ ?>
                    <?php if (!getAllJobEntriesForJobId($activeJobId)) {
                    } else { ?>
                        <li class="collapsed">
                            <a class="m-link" data-bs-toggle="collapse" data-bs-target="#client-Components" href="#"><i class="icofont-user-male"></i> <span>Active Job Data</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse" id="client-Components">
                                <li><a class="ms-link" href="job_summary"> <span>Summary</span></a></li>
                                <!-- <li><a class="ms-link" href="job_data"> <span>Data Visualisation</span></a></li> -->
                            </ul>
                        </li>
                    <?php }} ?>
                <?php } ?>



                <li class="collapsed">
                    <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Componentsone" href="#"><i class="icofont-ui-calculator"></i> <span>My Device</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Componentsone">
                        <li><a class="ms-link" href="machine-info"><span>Info</span> </a></li>
                        <!-- <li><a class="ms-link" href="machine-settings"><span>Settings</span> </a></li> -->
                    </ul>
                </li>
            <?php } ?>


            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Componentstwo" href="#"><i class="icofont-ui-calculator"></i> <span>Developer Section</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="menu-Componentstwo">
                    <li><a class="ms-link" href="test"><span>Test Page</span> </a></li>
                    <!-- <li><a class="ms-link" href="machine-settings"><span>Settings</span> </a></li> -->
                </ul>
            </li>
        </ul>

        <!-- Theme: Switch Theme -->
        <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-center justify-content-center">
                <div class="form-check form-switch theme-switch">
                    <input class="form-check-input" type="checkbox" id="theme-switch">
                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                </div>
            </li>
            <li class="d-flex align-items-center justify-content-center">
                <div class="form-check form-switch theme-rtl">
                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                </div>
            </li>
        </ul>

        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>