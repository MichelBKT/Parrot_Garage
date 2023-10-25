
function valueChanged()
{
  const value = document.querySelector(".value");
  const input = document.querySelector(".pi_input");
  value.textContent = input.value;
input.addEventListener("input", (event) => {
  value.textContent = event.target.value;
});

const value1 = document.querySelector(".value1");
const input1 = document.querySelector(".pi_input1");
value.textContent = input.value;
input1.addEventListener("input", (event) => {
  value1.textContent = event.target.value;
});

const value2 = document.querySelector(".value2");
const input2 = document.querySelector(".pi_input2");
value.textContent = input.value;
input2.addEventListener("input", (event) => {
  value2.textContent = event.target.value;
});
}

valueChanged();

