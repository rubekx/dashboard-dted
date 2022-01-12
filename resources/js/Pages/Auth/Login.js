import React, { useEffect } from 'react';
import Button from '@/Components/Button';
import Checkbox from '@/Components/Checkbox';
import Guest from '@/Layouts/Guest';
import Input from '@/Components/Input';
import Label from '@/Components/Label';
import ValidationErrors from '@/Components/ValidationErrors';
import { Head, Link, useForm } from '@inertiajs/inertia-react';
import Form from 'react-bootstrap/Form'

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: '',
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (
        <Guest>

            {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}

            <ValidationErrors errors={errors} />

            <form onSubmit={submit}>
                <Form.Group className="mb-3">
                    <div className="mt-4">
                        <Label forInput="email" value="E-mail" />

                        <Input
                            type="text"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full"
                            autoComplete="username"
                            isFocused={true}
                            handleChange={onHandleChange}
                        />
                    </div>

                    <div className="mt-4">
                        <Label forInput="password" value="Senha" />
                        <Input
                            type="password"
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full"
                            autoComplete="current-password"
                            handleChange={onHandleChange}
                        />
                    </div>

                </Form.Group>

                <Form.Group className="mb-3">
                    <div className="flex items-center justify-end mt-4">
                        {canResetPassword && (
                            <Link
                                href={route('password.request')}
                                className="text-sm text-blue-600 hover:text-blue-900"
                            >
                                Esqueci minha senha
                            </Link>
                        )}

                    </div>
                </Form.Group>
                <Form.Group className="mb-3">
                    <div className="text-center d-grid gap-2 d-md-block">
                        <Button className="btn-danger" processing={processing}>
                            Entrar
                        </Button>
                    </div>
                </Form.Group>
            </form>
        </Guest>
    );
}
