import React, {useEffect, useState} from 'react';
import {Link, useHistory} from 'react-router-dom';

import api from '../services/api';
import Doctor from '../components/Doctor';

function Search() {
    const history = useHistory();
    const [doctors, setDoctors] = useState([]);
    const [search, setSearch] = useState('');

    useEffect(() => {
        getDoctors();
    }, []);

    const getDoctors = async () => {
        await api.get('/doctors?token=' + localStorage.getItem('token') + (search ? '&search=' + search : ''))
            .then(async (res) => {
                await setDoctors(res.data);
            })
            .catch(() => {
                localStorage.setItem('token', '');
                history.push('/');
            });
    };

    const handleFormSubmit = e => {
        e.preventDefault();
        getDoctors();
    };

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8 pt-5">
                    <h1 className="text-primary text-center">DoctorsList</h1>
                    <div className="card border-0 text-center">
                        <div className="card-header">
                            <form onSubmit={(e) => handleFormSubmit(e)}>
                                <div className="input-group">
                                    <input type="text" className="form-control" placeholder="Pesquise por Nome ou CRM"
                                           aria-label="Pesquise por Nome ou CRM" aria-describedby="basic-addon2"
                                           onChange={e => setSearch(e.target.value)}/>
                                    <div className="input-group-append">
                                        <button className="btn btn-outline-primary" type="submit">
                                            <i className="fa fa-search"/>
                                        </button>

                                        <Link to="/doctor" className="btn btn-primary" type="button">
                                            <i className="fa fa-user-alt"/>
                                        </Link>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {!doctors.length && (<div className="card-body">
                            <p className="card-text">Sua pesquisa não obteve resultados</p>
                        </div>)}

                        {!!doctors.length && (
                            <div className="row">
                                <div className="col-12">
                                    <h3 className="card-title my-3">Médicos encontrados</h3>
                                </div>
                                {doctors.map((doctor) => (
                                    <Doctor key={doctor.id} doctor={doctor} listCallback={getDoctors}/>
                                ))}
                            </div>
                        )}

                        <div className="card-footer text-muted">
                            {doctors.length} resultados
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Search;
