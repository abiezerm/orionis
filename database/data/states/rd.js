const states = [
  { name: "Azua" },
  { name: "Baoruco" },
  { name: "Barahona" },
  { name: "Dajabón" },
  { name: "Distrito Nacional" },
  { name: "Duarte" },
  { name: "Elías Piña" },
  { name: "El Seibo" },
  { name: "Espaillat" },
  { name: "Hato Mayor" },
  { name: "Hermanas Mirabal" },
  { name: "Independencia" },
  { name: "La Altagracia" },
  { name: "La Romana" },
  { name: "La Vega" },
  { name: "María Trinidad Sánchez" },
  { name: "Monseñor Nouel" },
  { name: "Monte Cristi" },
  { name: "Monte Plata" },
  { name: "Pedernales" },
  { name: "Peravia" },
  { name: "Puerto Plata" },
  { name: "Samaná" },
  { name: "Sánchez Ramírez" },
  { name: "San Cristóbal" },
  { name: "San José de Ocoa" },
  { name: "San Juan" },
  { name: "San Pedro de Macorís" },
  { name: "Santiago" },
  { name: "Santiago Rodríguez" },
  { name: "Santo Domingo" },
  { name: "Valverde" }
];

const querys = states.map((state) => {
  const sql = `INSERT INTO state(name, code, country_id) VALUES ("${state.name}", '', 62);`;
  return sql;
});

console.log(querys.join("\n"));
