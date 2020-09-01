import React from 'react';
import {Link} from 'react-router-dom';
import api from "../services/api";

function Doctor({doctor, listCallback}) {

    const handleDelete = e => {
        e.preventDefault();
        if (confirm('Deseja excluir?')) {
            api.delete('/doctors/' + doctor.id + '?token=' + localStorage.getItem('token'))
                .then(() => {
                    alert('Excluido com sucesso!');
                    listCallback();
                })
                .catch(() => alert('Erro ao excluir'))
        }
    };


    return (
        <div className="col-12 col-sm-6 pt-5 py-2">
            <div className="card border-primary m-2">
                <div className="card-header bg-white text-primary d-flex justify-content-between align-content-around">
                    <h3 className="py-2 my-0">
                        {doctor.name}
                    </h3>
                    <div>
                        <Link to={{pathname: "/doctor", state: {doctor}}} className="btn btn-link">
                            <i className="fa fa-edit"/>
                        </Link>
                        <button className="btn btn-link" onClick={e => handleDelete(e)}>
                            <i className="fa fa-trash"/>
                        </button>
                    </div>
                </div>
                <div className="card-body">
                    <div className="col-12">
                        {doctor.specialties && doctor.specialties.map(spec => (
                                <a key={spec.id}
                                   href={`https://www.google.com/search?q=${spec.name}`}
                                   target="_blank"
                                   className="badge badge-primary m-1">
                                    {spec.name}
                                </a>
                            )
                        )}
                    </div>
                </div>
                <div className="card-footer bg-white d-flex justify-content-around align-items-between">
                    <span>CRM: {doctor.crm}</span>
                    <a href={"tel:" + doctor.phone}>
                        <i className="fa fa-phone"/> {doctor.phone}
                    </a>
                </div>
            </div>
        </div>
    );
}

export default Doctor;
