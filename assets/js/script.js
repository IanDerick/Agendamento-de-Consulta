document.addEventListener("DOMContentLoaded", function () {
  // --------------------------
  // 1. Ativar link da Navbar
  // --------------------------
  const links = document.querySelectorAll(".nav-link");
  const currentPage = window.location.pathname.split("/").pop();

  links.forEach(link => {
    const linkHref = link.getAttribute("href").split("/").pop();
    if (linkHref === currentPage) {
      link.classList.add("active");
    }
  });

  // --------------------------
  // 2. Mostrar informações (seta)
  // --------------------------
  window.mostrarInformacoes = function (event) {
    event.preventDefault();
    const info = document.getElementById("infoEditaAgendamento");
    const icone = document.getElementById("iconeSeta");
    if (!info || !icone) return;

    info.classList.toggle("visivel");

    if (info.classList.contains("visivel")) {
      icone.classList.replace("bi-arrow-down", "bi-arrow-up");
    } else {
      icone.classList.replace("bi-arrow-up", "bi-arrow-down");
    }
  };

  // --------------------------
  // 3. Modal Edita Paciente
  // --------------------------
  const modalEditaPaciente = document.getElementById("modalEditaPaciente");
  if (modalEditaPaciente) {
    modalEditaPaciente.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;

      modalEditaPaciente.querySelector("#codpaciente").value = button.getAttribute("data-id");
      modalEditaPaciente.querySelector("#nome").value = button.getAttribute("data-nome");
      modalEditaPaciente.querySelector("#cpf").value = button.getAttribute("data-cpf");
      modalEditaPaciente.querySelector("#email").value = button.getAttribute("data-email");
      modalEditaPaciente.querySelector("#telefone").value = button.getAttribute("data-telefone");

      modalEditaPaciente.querySelector("#previewNome").textContent = button.getAttribute("data-nome");
    });
  }

  // --------------------------
  // 4. Modal Edita Doutor
  // --------------------------
  const modalEditaDoutor = document.getElementById("modalEditaDoutor");
  if (modalEditaDoutor) {
    modalEditaDoutor.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;

      modalEditaDoutor.querySelector("#coddoutor").value = button.getAttribute("data-id");
      modalEditaDoutor.querySelector("#nome").value = button.getAttribute("data-nome");
      modalEditaDoutor.querySelector("#email").value = button.getAttribute("data-email");

      if (button.getAttribute("data-status") == "1") {
        modalEditaDoutor.querySelector("#ativo").checked = true;
      } else {
        modalEditaDoutor.querySelector("#inativo").checked = true;
      }

      modalEditaDoutor.querySelector("#previewNome").textContent = button.getAttribute("data-nome");
    });
  }

  // --------------------------
  // 5. Autocomplete Paciente
  // --------------------------
  const inputPaciente = document.getElementById("nome");
  const sugestoesPaciente = document.getElementById("sugestoesPaciente");
  const emailPaciente = document.getElementById("email");
  const codPacienteHidden = document.getElementById("codPacienteHidden"); // campo hidden opcional

  if (inputPaciente && sugestoesPaciente) {
    inputPaciente.addEventListener("keyup", () => {
      let termo = inputPaciente.value.trim();

      if (termo.length < 2) {
        sugestoesPaciente.innerHTML = "";
        return;
      }

      fetch("../actions/buscar_paciente.php?nome=" + encodeURIComponent(termo))
        .then(res => res.json())
        .then(data => {
          sugestoesPaciente.innerHTML = "";

          if (data.length === 0) {
            let item = document.createElement("div");
            item.classList.add("list-group-item", "disabled");
            item.textContent = "Nenhum paciente encontrado";
            sugestoesPaciente.appendChild(item);
            return;
          }

          data.forEach(paciente => {
            let item = document.createElement("a");
            item.classList.add("list-group-item", "list-group-item-action");
            item.textContent = paciente.nome;
            item.onclick = () => {
              inputPaciente.value = paciente.nome;
              if (emailPaciente) emailPaciente.value = paciente.email;
              if (codPacienteHidden) codPacienteHidden.value = paciente.codpaciente; // guarda o ID
              sugestoesPaciente.innerHTML = "";
            };
            sugestoesPaciente.appendChild(item);
          });
        });
    });
  }

  // --------------------------
  // 6. Popular select Doutor no modal_novo_agendamento.php
  // --------------------------
  const selectDoutor = document.getElementById("SelectDoutor");

// Função para carregar doutores em qualquer select
function carregarDoutores(selectElement) {
  if (!selectElement) return;

  fetch("../actions/buscar_doutor.php")
    .then(res => res.json())
    .then(data => {
      selectElement.innerHTML = '<option value="">Selecione</option>';
      if (Array.isArray(data) && data.length > 0) {
        data.forEach(doutor => {
          const option = document.createElement("option");
          option.value = doutor.CODDOUTOR;
          option.textContent = doutor.NOME;
          selectElement.appendChild(option);
        });
      } else {
        const option = document.createElement("option");
        option.value = "";
        option.textContent = "Nenhum doutor cadastrado";
        selectElement.appendChild(option);
      }
    })
    .catch(err => {
      console.error("Erro ao carregar doutores:", err);
      selectElement.innerHTML = '<option value="">Erro ao carregar doutores</option>';
    });
}

// --------------------------
// 7. Modal Edita Agendamento
// --------------------------
const modalEditaAgendamento = document.getElementById("modalEditaAgendamento");
if (modalEditaAgendamento) {
  modalEditaAgendamento.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;

    modalEditaAgendamento.querySelector("#idagendamento").value = button.getAttribute("data-idagendamento");
    modalEditaAgendamento.querySelector("#nome").value = button.getAttribute("data-nome");
    modalEditaAgendamento.querySelector("#email").value = button.getAttribute("data-email");

    // Data dd/mm/yyyy → yyyy-mm-dd
    const dataConsulta = button.getAttribute("data-data");
    if (dataConsulta) {
      let partes = dataConsulta.split("/");
      if (partes.length === 3) {
        modalEditaAgendamento.querySelector("#dtconsulta").value = `${partes[2]}-${partes[1]}-${partes[0]}`;
      }
    }

    modalEditaAgendamento.querySelector("#horainicio").value = button.getAttribute("data-horainicio");
    modalEditaAgendamento.querySelector("#horafim").value = button.getAttribute("data-horafim");

    // Carregar doutores e selecionar automaticamente
    const selectDoutorEdita = modalEditaAgendamento.querySelector("#selectDoutorEdita");
    const coddoutor = button.getAttribute("data-doutor");

    carregarDoutores(selectDoutorEdita);
    setTimeout(() => {
      if (selectDoutorEdita) selectDoutorEdita.value = coddoutor;
    }, 150);
  });
}

// Carregar doutores no modal Novo Agendamento
const selectDoutorNovo = document.getElementById("selectDoutorNovo");
carregarDoutores(selectDoutorNovo);

});
