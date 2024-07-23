import React from "react";
import { useNavigate } from "react-router-dom";

export const Home: React.FC = () => {
  const Navigate = useNavigate();
  return (
    <div className="home">
      <h2> Welcome</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit sunt
        soluta fuga corrupti velit ipsa nisi, deleniti, assumenda expedita
        aliquam autem non placeat necessitatibus. Nihil dolorem omnis cum
        aspernatur voluptas!
      </p>

      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi porro
        doloribus deleniti totam delectus quam explicabo ipsa dolorem iure eius
        laboriosam ducimus nam iusto, saepe veritatis corrupti omnis! Aperiam,
        vero.
      </p>

      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit deserunt
        voluptatem eius maxime quidem facere officiis in odit accusamus
        veritatis exercitationem ab iusto repellendus, officia at qui
        reprehenderit iure! Necessitatibus.
      </p>
      <button onClick={() => Navigate("order-summary")}> Place Order</button>
    </div>
  );
};
