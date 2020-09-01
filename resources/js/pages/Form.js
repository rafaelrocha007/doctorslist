import React, {useEffect, useState} from 'react';
import {Link, useHistory, useLocation} from 'react-router-dom';
import api from '../services/api';

function Form() {
    let location = useLocation();
    const doctor = location?.state?.doctor || {};

    const history = useHistory();
    const [specialtiesList, setSpecialtiesList] = useState([]);
    const [specialty, setSpecialty] = useState('');

    const [name, setName] = useState(doctor.name);
    const [crm, setCrm] = useState(doctor.crm);
    const [phone, setPhone] = useState(doctor.phone);
    const [specialties, setSpecialties] = useState(doctor.specialties || []);

    useEffect(() => {
        (async () => {
            await !localStorage.getItem('token') && await history.push('/')
        })();
        getSpecialties();
    }, []);

    const getSpecialties = async () => {
        await api.get('/specialties?token=' + localStorage.getItem('token'))
            .then(async (res) => {
                await setSpecialtiesList(res.data);
            })
            .catch(() => {
                localStorage.setItem('token', '');
                history.push('/');
            });
    };

    const handleChooseSpecialty = async (e) => {
        e.preventDefault();

        function specialtyExists(id) {
            return (specialties.filter((s) => s.id == id).length > 0);
        }

        if (!specialtyExists(specialty)) {
            const specialtyChoosen = specialtiesList.filter(s => s.id == specialty)[0];
            setSpecialties([...specialties, specialtyChoosen]);
        }
    };

    const handleSave = async (e) => {
        e.preventDefault();

        if (specialties.length < 2) {
            alert('Selecione pelo menos 2 especialidades');
            return false;
        }

        const method = doctor.id ? 'put' : 'post';
        const url = '/doctors' + (doctor.id ? '/' + doctor.id : '');

        await api[method](url + '?token=' + localStorage.getItem('token'), {
            name,
            crm,
            phone,
            "specialties": specialties.map(s => s.id)
        })
            .then((res) => {
                history.push('/home');
            })
            .catch(() => {
                alert('Erro ao salvar');
                //history.push('/')
            })
    };

    const handleRemoveChoosenSpecialty = (id) => {
        setSpecialties(specialties.filter(s => s.id != id));
    };

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-12 col-sm-6 pt-5">
                    <h1 className="text-primary text-center pb-5">DoctorsList</h1>
                    <div className="card text-center p-5">
                        <div className="card-body w-100 d-flex flex-column justify-content-center align-items-center">
                            {!doctor.id && <h5 className="card-title">Cadastre um novo médico</h5>}
                            {!!doctor.id && <h5 className="card-title">Editando {doctor.name} </h5>}
                            <form className="form d-block w-100" onSubmit={e => handleSave(e)}>
                                <input type="text"
                                       className="form-control my-2"
                                       placeholder="Nome"
                                       required
                                       value={name}
                                       onChange={e => setName(e.target.value)}/>

                                <input type="text"
                                       className="form-control my-2"
                                       placeholder="CRM"
                                       required
                                       value={crm}
                                       onChange={e => setCrm(e.target.value)}/>

                                <input type="text"
                                       className="form-control my-2"
                                       placeholder="Telefone"
                                       required
                                       value={phone}
                                       onChange={e => setPhone(e.target.value)}/>

                                <hr/>

                                <h5 className="mt-5">Especialidades</h5>

                                <div className="input-group w-100">
                                    <select className="form-control" value={specialty}
                                            onChange={e => setSpecialty(e.target.value)}>
                                        <option value="" disabled hidden>
                                            Selecione uma opção
                                        </option>
                                        {specialtiesList.map((option) => {
                                            return (
                                                <option key={option.id} value={option.id}>
                                                    {option.name}
                                                </option>
                                            );
                                        })}
                                    </select>
                                    <div className="input-group-append">
                                        <button type="button"
                                                className="btn btn-outline-primary"
                                                onClick={handleChooseSpecialty}>
                                            <i className="fa fa-plus"/>
                                        </button>
                                    </div>
                                </div>

                                <div className="col-12 pt-3">
                                    {specialties.map((spec, i) => {
                                        return (
                                            <div key={spec.id}>
                                                <div className="text-primary d-flex justify-content-between pt-1">
                                                    <span>{spec.name}</span>
                                                    <button className="btn btn-link" type="button"
                                                            onClick={() => handleRemoveChoosenSpecialty(spec.id)}>
                                                        <i className="fa fa-times"/>
                                                    </button>
                                                </div>
                                                <hr className="my-1 p-0"/>
                                            </div>
                                        );
                                    })}
                                </div>

                                <div className="row">
                                    <div className="col-12 d-flex justify-content-between">
                                        <Link to="/" className="btn btn-outline-primary mt-5">
                                            <i className="fa fa-chevron-left"/> Voltar
                                        </Link>
                                        <button className="btn btn-primary mt-5" type="submit">
                                            <i className="fa fa-check"/> {doctor.id ? 'Salvar' : 'Cadastrar'}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Form;
