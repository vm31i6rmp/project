import ReactDOM from "react-dom";
import React from "react";
import Header from "./components/tsx/Header";
import Main from "./components/tsx/Main";
import "./index.css";

ReactDOM.render(
    <>
        <Header />
        <Main />
    </>,
    document.getElementById("root")
);