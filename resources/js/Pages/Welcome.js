import React from 'react';
import { Link, Head } from '@inertiajs/inertia-react';
import Login from '@/Pages/Auth/Login';

export default function Welcome() {
    return (
        <>
            <Head title="Welcome" />
            <Login canResetPassword={true}></Login>
        </>
    );
}
