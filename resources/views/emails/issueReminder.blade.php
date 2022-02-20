<div>
    <div style="background: #056b5b; color: white; border-radius:5px;padding:10px;box-size:border-box;">
        <h1>Project Management</h1>
    </div>

    <div style="margin: 20px;padding:10px;box-size:border-box;">
        <p>Dear {{ $issue->manager->first_name }} {{ $issue->manager->last_name }}</p>
        <p>Reminder:</p>
        <p>A user logged a new issue.</p>
        <p style="display: flex; margin-left: 10px;">Issue title: <span style=" font-weight: 900;"> {{ $issue->title }}</span></p>
        <p><a href="http://projectmanagement.com/login">Login</a> into your account to comment.</p>
        <p>Thank you.</p>
        <p>Regards,</p>
        <p>Project Management</p>
    </div>

</div>
