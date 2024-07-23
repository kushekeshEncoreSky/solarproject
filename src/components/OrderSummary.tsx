import React from "react";
import { useNavigate } from "react-router-dom";
export const OrderSummary: React.FC = () => {
  const navigate = useNavigate();
  const goback = (): any => {
    navigate(-1);
  };
  return (
    <div className="orderSummary">
      <h2>Order confirmed</h2>
      <button onClick={goback}> Go back button</button>
    </div>
  );
};
