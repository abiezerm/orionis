const states = [
  {
    name: "Alberta",
    abbreviation: "AB"
  },
  {
    name: "British Columbia",
    abbreviation: "BC"
  },
  {
    name: "Manitoba",
    abbreviation: "MB"
  },
  {
    name: "New Brunswick",
    abbreviation: "NB"
  },
  {
    name: "Newfoundland and Labrador",
    abbreviation: "NL"
  },
  {
    name: "Northwest Territories",
    abbreviation: "NT"
  },
  {
    name: "Nova Scotia",
    abbreviation: "NS"
  },
  {
    name: "Nunavut",
    abbreviation: "NU"
  },
  {
    name: "Ontario",
    abbreviation: "ON"
  },
  {
    name: "Prince Edward Island",
    abbreviation: "PE"
  },
  {
    name: "Quebec",
    abbreviation: "QC"
  },
  {
    name: "Saskatchewan",
    abbreviation: "SK"
  },
  {
    name: "Yukon Territory",
    abbreviation: "YT"
  }
];

const querys = states.map((state) => {
  const sql = `INSERT INTO state(name, code, country_id) VALUES ("${state.name}", '${state.abbreviation}', 39);`;
  return sql;
});

console.log(querys.join("\n"));
