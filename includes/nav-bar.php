<nav>
    <a href="index.php" style="text-decoration: none;"><div class="logo">
        <img src="./assets/Logo.png" alt="">
        <h1 style="color: #d47b33;">MAIDEN HOME</h1>
    </div></a>
    <div class="search">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#484848" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
            <path d="m21 21-4.34-4.34" />
            <circle cx="11" cy="11" r="8" />
        </svg>
        <input name="search" type="search" placeholder="What are you looking for?">
    </div>
    <div class="nav-options-wrapper">
        <div class="user-dropdown">
            <button type="button" class="nav-options" onclick="toggleUser()">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user">
                    <circle cx="12" cy="12" r="10" />
                    <circle cx="12" cy="10" r="3" />
                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                </svg>
            </button>
            <div class="dropdown-content">
                <div style="display: flex; gap: 10px; padding: 10px 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="10" r="3" />
                        <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                    </svg>
                    <div>
                        <?php if (isset($_SESSION['username']) && isset($_SESSION['user_email'])): ?>
                            <p id="username"><?= htmlspecialchars($_SESSION['username']); ?></p>
                            <p id="email"><?= htmlspecialchars($_SESSION['user_email']); ?></p>
                        <?php else: ?>
                            <p id="username" style="display:flex; align-items:center; height:100%;">Guest</p>
                        <?php endif; ?>
                    </div>
                </div>
                <hr style="margin: 10px 0;">
                <?php if (isset($_SESSION['username']) && isset($_SESSION['user_email'])): ?>
                    <ul style="display: flex; flex-direction: column; gap: 12px;">
                        <li>
                            <a>
                                <div style="display: flex; align-items:center; gap:8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    <a>Profile</a>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a>
                                <div style="display: flex; align-items:center; gap:8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag">
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                        <path d="M3.103 6.034h17.794" />
                                        <path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                                    </svg>
                                    <p>Orders</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="./functions/logout.php">
                                <div style="display: flex; align-items:center; gap:8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
                                        <path d="m16 17 5-5-5-5" />
                                        <path d="M21 12H9" />
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    </svg>
                                    <p>Sign Out</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul style="display: flex; flex-direction: column; gap: 10px;">
                        <li><a href="./login.php">Login</a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <a class="nav-options"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart">
                <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
            </svg></a>
        <a class="nav-options"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                <circle cx="8" cy="21" r="1" />
                <circle cx="19" cy="21" r="1" />
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
            </svg></a>
    </div>
</nav>