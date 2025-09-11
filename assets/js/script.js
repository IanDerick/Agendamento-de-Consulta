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

      if (button.getAttribute("data-status") === "1") {
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
  function inicializarAutocomplete(container) {
    const inputPaciente = container.querySelector("input[name='nome']");
    const sugestoesPaciente = container.querySelector("#sugestoesPaciente");
    const emailPaciente = container.querySelector("input[name='email']");
    const codPacienteHidden = container.querySelector("#codPacienteHidden");

    if (!inputPaciente || !sugestoesPaciente) return;

    inputPaciente.addEventListener("keyup", () => {
      const termo = inputPaciente.value.trim();

      // Limpa campo codPacienteHidden se usuário digitar algo novo
      if (codPacienteHidden) codPacienteHidden.value = "";

      if (termo.length < 2) {
        sugestoesPaciente.innerHTML = "";
        return;
      }

      fetch("../actions/buscar_paciente.php?nome=" + encodeURIComponent(termo))
        .then(res => res.json())
        .then(data => {
          sugestoesPaciente.innerHTML = "";

          if (!Array.isArray(data) || data.length === 0) {
            const item = document.createElement("div");
            item.classList.add("list-group-item", "disabled");
            item.textContent = "Nenhum paciente encontrado";
            sugestoesPaciente.appendChild(item);
            return;
          }

          data.forEach(paciente => {
            const item = document.createElement("a");
            item.classList.add("list-group-item", "list-group-item-action");
            item.href = "#";
            item.textContent = paciente.nome;

            item.addEventListener("click", (e) => {
              e.preventDefault();
              inputPaciente.value = paciente.nome;
              if (emailPaciente) emailPaciente.value = paciente.email || "";
              if (codPacienteHidden) codPacienteHidden.value = paciente.codpaciente || "";
              sugestoesPaciente.innerHTML = "";
            });

            sugestoesPaciente.appendChild(item);
          });
        })
        .catch(err => {
          console.error("Erro ao buscar pacientes:", err);
          sugestoesPaciente.innerHTML = '<div class="list-group-item disabled">Erro na busca</div>';
        });
    });
  }

  // --------------------------
  // 6. Popular select Doutor
  // --------------------------
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
  // Variáveis para modais usados abaixo
  // --------------------------
  const modalNovoAgendamento = document.getElementById("modalNovoAgendamento");
  const modalEditaAgendamento = document.getElementById("modalEditaAgendamento");

  // --------------------------
  // Inicializar autocomplete nos modais de agendamento
  // --------------------------
  if (modalNovoAgendamento) {
    modalNovoAgendamento.addEventListener("shown.bs.modal", () => {
      inicializarAutocomplete(modalNovoAgendamento);
    });
  }

  if (modalEditaAgendamento) {
    modalEditaAgendamento.addEventListener("shown.bs.modal", () => {
      inicializarAutocomplete(modalEditaAgendamento);
    });
  }

  // --------------------------
  // 7. Modal Edita Agendamento - popular campos e carregar doutores
  // --------------------------
  if (modalEditaAgendamento) {
    modalEditaAgendamento.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;

      modalEditaAgendamento.querySelector("#idagendamento").value = button.getAttribute("data-idagendamento") || "";
      modalEditaAgendamento.querySelector("#nome").value = button.getAttribute("data-nome") || "";
      modalEditaAgendamento.querySelector("#email").value = button.getAttribute("data-email") || "";

      // Preenche o hidden do codpaciente (muito importante!)
      modalEditaAgendamento.querySelector("#codPacienteHidden").value = button.getAttribute("data-codpaciente") || "";

      const dataConsulta = button.getAttribute("data-data");
      if (dataConsulta) {
        const partes = dataConsulta.split("/");
        if (partes.length === 3) {
          modalEditaAgendamento.querySelector("#dtconsulta").value = `${partes[2]}-${partes[1]}-${partes[0]}`;
        }
      }

      modalEditaAgendamento.querySelector("#horainicio").value = button.getAttribute("data-horainicio") || "";
      modalEditaAgendamento.querySelector("#horafim").value = button.getAttribute("data-horafim") || "";

      const selectDoutorEdita = modalEditaAgendamento.querySelector("#selectDoutorEdita");
      const coddoutor = button.getAttribute("data-doutor") || "";

      carregarDoutores(selectDoutorEdita);
      setTimeout(() => {
        if (selectDoutorEdita) selectDoutorEdita.value = coddoutor;
      }, 150);
    });
  }

  // --------------------------
  // 8. Carregar doutores no modal Novo Agendamento
  // --------------------------
  const selectDoutorNovo = document.getElementById("selectDoutorNovo");
  carregarDoutores(selectDoutorNovo);

});
