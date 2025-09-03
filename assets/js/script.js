document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".nav-link");
  const currentPage = window.location.pathname.split("/").pop();

  links.forEach(link => {
    const linkHref = link.getAttribute("href").split("/").pop();
  
    if (linkHref === currentPage) {
      link.classList.add("active");
    }
  });
});
// Mostra as informações de exames
function mostrarInformacoes(event) {
  event.preventDefault();
  const info = document.getElementById("infoEditaAgendamento");
  const icone = document.getElementById("iconeSeta");
  if (!info || !icone) return;

  info.classList.toggle("visivel");

  if (info.classList.contains("visivel")) {
    icone.classList.remove("bi-arrow-down");
    icone.classList.add("bi-arrow-up");
  } else {
    icone.classList.remove("bi-arrow-up");
    icone.classList.add("bi-arrow-down");
  }
}
document.addEventListener('DOMContentLoaded', function () {
  const modalEdita = document.getElementById('modalEditaPaciente');
  modalEdita.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;

      const id = button.getAttribute('data-id');
      const nome = button.getAttribute('data-nome');
      const cpf = button.getAttribute('data-cpf');
      const email = button.getAttribute('data-email');
      const telefone = button.getAttribute('data-telefone');

      modalEdita.querySelector('#codpaciente').value = id;
      modalEdita.querySelector('#nome').value = nome;
      modalEdita.querySelector('#cpf').value = cpf;
      modalEdita.querySelector('#email').value = email;
      modalEdita.querySelector('#telefone').value = telefone;
  });
});
