<div>
    <div style="background: #056b5b; color: white; border-radius:5px;padding:10px;box-size:border-box;">
        <h1>Project Management</h1>
    </div>

    <div style="margin: 20px;padding:10px;box-size:border-box;">
        <p>Dear {{ $user->first_name }} {{ $user->last_name }}</p>
        <p>Your account has been created.</p>
        <p>Login Details</p>
        <p style="display: flex; margin-left: 10px;">Email: <span style=" font-weight: 900;"> {{ $user->email }}</span></p>
        <p style="display: flex; margin-left: 10px;">Password: <span style=" font-weight: 900;">{{ $user->national_id }}</span></p>
        <p>Please make sure to change this password as soon as possible this is not safe.</p>
        <p>Login <a href="http://projectmanagement.com/login">Here</a></p>
        <p>Thank you.</p>
        <p>Regards,</p>
        <p>Project Management</p>
    </div>

</div>
