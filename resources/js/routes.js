import React from "react";

import {BrowserRouter, Route} from "react-router-dom";

import Login from "./pages/Login";
import Search from "./pages/Search";
import Form from "./pages/Form";

function Routes() {
    return (
        <BrowserRouter>
            <Route path="/" exact component={Login}/>
            <Route path="/home" component={Search}/>
            <Route path="/doctor" component={Form}/>
        </BrowserRouter>
    );
}

export default Routes;
