<div class="widget admin-widget p-0">
    <div class="Profile-menu">
        <ul class="nav secondary-nav">
            <li class="nav-item active"><a class="nav-link" href="dashboard.html"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fab fa-autoprefixer"></i>Account</a></li>
            <li class="nav-item"><a class="nav-link" href="profile-bank.html"><i class="fas fa-university"></i>Bank Accounts</a></li>
            <li class="nav-item"><a class="nav-link" href="profile-cards.html"><i class="fas fa-building"></i>Bank Cards</a></li>
            <li class="nav-item"><a class="nav-link" href="pay-contact.html"><i class="far fa-list-alt"></i>Contacts List</a></li>
            <li class="nav-item"><a class="nav-link" href="deposit-money.html"><i class="fas fa-plus"></i>Deposit Money</a></li>
            <li class="nav-item"><a class="nav-link" href="send-money.html"><i class="far fa-paper-plane"></i>Send Money</a></li>
            <li class="nav-item"><a class="nav-link" href="request-money.html"><i class="fas fa-piggy-bank"></i>Request Money</a></li>
            <li class="nav-item"><a class="nav-link" href="withdraw-money.html"><i class="fas fa-wallet"></i>Withdarw Money</a></li>
            <li class="nav-item"><a class="nav-link" href="transactions.html"><i class="fas fa-list-ul"></i>Transaction</a></li>
            <li class="nav-item"><a class="nav-link" href="profile-notifications.html"><i class="fas fa-cog"></i>Setting</a></li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-cog"></i>Deconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
            </li>
        </ul>
    </div>
</div>

<div class="widget admin-widget">
    <i class="fas fa-coins admin-overlay-icon"></i>
    <h2>Earn $25</h2>
    <p>Have questions or concerns regrading</p>
    <a href="#" class="btn btn-default btn-center"><span>Refer A friend</span></a>
</div>

<div class="widget admin-widget">
    <i class="fas fa-comments admin-overlay-icon"></i>
    <h2>Need Help?</h2>
    <p>Have questions or concerns regrading your account?<br>
        Our experts are here to help!.</p>
    <a href="#" class="btn btn-default btn-center"><span>Start Chat</span></a>
</div>
