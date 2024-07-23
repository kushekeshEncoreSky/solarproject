import { BrowserRouter, Routes, Route, Link, NavLink } from "react-router-dom";
import "./App.css";
import { Home } from "./components/Home";
import { About } from "./components/About";
import { OrderSummary } from "./components/OrderSummary";
import { NoMatch } from "./components/NoMatch";
import { Users } from "./components/Users";
import { Profile } from "./components/Profile";
import { lazy } from "react";
import { Suspense } from "react";
import React from "react";

const Lazyloading = React.lazy(() => {
  return import("./components/Lazyloading");
});
const App: React.FC = () => {
  return (
    <BrowserRouter>
      <header>
        <nav>
          <h1> jobREcureter</h1>
          <NavLink to="/"> Home</NavLink>
          <NavLink to="about">About</NavLink>
          <NavLink to="order-summary"> OrderSummary</NavLink>
          <NavLink to="profile"> Profile</NavLink>
        </nav>
      </header>
      <main>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="about" element={<About />} />
          <Route path="order-summary" element={<OrderSummary />} />
          <Route path="*" element={<NoMatch />} />
          <Route path="user" element={<Users />} />
          <Route
            path="lazyloading"
            element={
              <Suspense fallback="loading...">
                <Lazyloading />
              </Suspense>
            }
          />
          <Route path="profile" element={<Profile />} />
        </Routes>
      </main>
    </BrowserRouter>
  );
};

export default App;
