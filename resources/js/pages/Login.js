import React, {useEffect, useState} from 'react';
import {useHistory} from 'react-router-dom';
import api from '../services/api';

function Login() {
    const history = useHistory();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [loginError, setLoginError] = useState('');

    useEffect(() => {
        (async () => {
            await localStorage.getItem('token') && await history.push('/home')
        })();
    }, []);

    const doLogin = async (e) => {
        e.preventDefault();
        console.log('login');
        await api.post('/auth/login', {"email": email, "password": password})
            .then((res) => {
                setToken(res.data.access_token);
                history.push('/home');
            })
            .catch(() => {
                setLoginError('Erro ao efetuar login.');
                setToken('');
            })
    };

    const setToken = (token) => {
        localStorage.setItem('token', token);
    };

    const getToken = () => localStorage.getItem('token');

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-12 col-sm-6 pt-5">
                    <h1 className="text-primary text-center pb-5">DoctorsList</h1>
                    <div className="card text-center p-5">
                        <div className="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 className="card-title">Seja bem vindo!</h5>
                            {!!loginError && (<b className="text-danger">{loginError}</b>)}
                            <form onSubmit={doLogin}>
                                <input type="text" className="form-control my-2" placeholder="email"
                                       aria-label="Pesquise por Nome ou CRM" aria-describedby="email" required
                                       onChange={e => setEmail(e.target.value)}/>
                                <input type="password" className="form-control my-2" placeholder="senha" required
                                       aria-label="Pesquise por Nome ou CRM" aria-describedby="senha"
                                       onChange={e => setPassword(e.target.value)}/>
                                <button className="btn btn-outline-primary my-2" type="submit">
                                    <i className="fa fa-key"/> Logar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login;
