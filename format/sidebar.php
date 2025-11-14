<div class="py-3 text-center" style="margin-bottom: 0.5rem;">
    <!-- avatar/icon -->
    <div class="mb-2" style="font-size: 2.2rem; color: #ffffff;">
        <i class="mdi mdi-badge-account"></i>
    </div>

    <!-- full name -->
    <?php if ($full_name !== ''): ?>
        <div style="margin-top: 4px; font-size: 0.95rem; color: #ffffff; font-weight: 700;">
            <?= htmlspecialchars($full_name) ?>
        </div>
    <?php endif; ?>

        <!-- username -->
        <div style="font-size: 0.85rem; color: #f0f0f0; font-weight: 600;">
        Username:
        <span style="color: #ffffff; font-weight: 700;">
            <?= htmlspecialchars($username) ?>
        </span>
    </div>
</div>




<ul class="side-nav">
    <li class="side-nav-item">
        <a href="../book/book.php" class="side-nav-link">
        
            <i class="uil uil-books"></i>

            <span> Manage Books </span>
        </a>
    </li>
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
            <i class="uil-users-alt me-1"></i>
            <span> Accounts</span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEcommerce">
            <ul class="side-nav-second-level">
                <li>
                    <a href="../admin/admin.php">Admin</a>
                </li>
                <li>
                    <a href="../student/students.php">Students</a>
                </li>

            </ul>
        </div>
    </li>

    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
            <i class="uil-clipboard-alt"></i>
            <span> Transactions </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEmail">
            <ul class="side-nav-second-level">
                <li>
                    <a href="../transaction/borrow.php">Borrow</a>
                </li>
                <li>
                    <a href="../transaction/return.php">Return</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="side-nav-item">
     <a class="side-nav-link" href="../admin/view-activity.php">
        <span>
<i class="uil uil-file-alt"></i>

Activity Log</span>
    </a>
    </li>


    <li class="side-nav-item">
        <a href="/LibraryManagementSystem/logout.php" class="side-nav-link">
            <i class="mdi mdi-logout me-1"></i>
            <span> Logout </span>
        </a>
    </li>

</ul>
</div>
</li>
</ul>


<div class="clearfix"></div>
</div>


</div>

<div class="content-page">
    <div class="content">
        <br>