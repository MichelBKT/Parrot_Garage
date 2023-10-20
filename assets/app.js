/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import { Tooltip, Toast, Popover } from 'bootstrap'

// start the Stimulus application
import './bootstrap';

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