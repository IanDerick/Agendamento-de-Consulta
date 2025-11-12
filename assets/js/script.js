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
  // 2. Modal Edita Paciente
  // --------------------------
  const modalEditaPaciente = document.getElementById("modalEditaPaciente");

  if (modalEditaPaciente) {
    modalEditaPaciente.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      const codpaciente = button.getAttribute("data-id");
  
      // Função de formatação CPF
      function formatarCPF(cpf) {
        if (!cpf) return "";
        cpf = cpf.replace(/\D/g, "");
        if (cpf.length > 11) cpf = cpf.substring(0, 11);
        if (cpf.length !== 11) return cpf;
        return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
      }
  
      // Função de formatação Telefone
      function formatarTelefone(telefone) {
        if (!telefone) return "";
        telefone = telefone.replace(/\D/g, "");
        if (telefone.length > 11) telefone = telefone.substring(0, 11);
        if (telefone.length === 10) {
          // fixo
          return telefone.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
        } else if (telefone.length === 11) {
          // celular
          return telefone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
        } else {
          return telefone;
        }
      }
  
      // Campos
      const nomeField = modalEditaPaciente.querySelector("#nome");
      const cpfField = modalEditaPaciente.querySelector("#cpf");
      const emailField = modalEditaPaciente.querySelector("#email");
      const telefoneField = modalEditaPaciente.querySelector("#telefone");
      const previewNome = modalEditaPaciente.querySelector("#previewNome");
      const codPacienteField = modalEditaPaciente.querySelector("#codpaciente");
      const codPacienteExameField = modalEditaPaciente.querySelector("#codpaciente_exame");
      const listaExames = modalEditaPaciente.querySelector("#listaExames");
  
      // Preenche campos com formatação
      codPacienteField.value = codpaciente;
      nomeField.value = button.getAttribute("data-nome") || "";
      cpfField.value = formatarCPF(button.getAttribute("data-cpf") || "");
      emailField.value = button.getAttribute("data-email") || "";
      telefoneField.value = formatarTelefone(button.getAttribute("data-telefone") || "");
      previewNome.textContent = button.getAttribute("data-nome") || "";
      codPacienteExameField.value = codpaciente;
  
      // Limita e formata CPF em tempo real
      cpfField.addEventListener("input", () => {
        let value = cpfField.value.replace(/\D/g, ""); // remove não numéricos
        if (value.length > 11) value = value.substring(0, 11);
        cpfField.value = formatarCPF(value);
      });
  
      // Limita e formata Telefone em tempo real
      telefoneField.addEventListener("input", () => {
        let value = telefoneField.value.replace(/\D/g, "");
        if (value.length > 11) value = value.substring(0, 11);
        telefoneField.value = formatarTelefone(value);
      });
  
      // Carrega exames via AJAX
      fetch(`../actions/listar_exames.php?codpaciente=${codpaciente}`)
        .then(response => response.text())
        .then(html => {
          listaExames.innerHTML = html;
        })
        .catch(error => {
          listaExames.innerHTML = "<div class='text-danger'>Erro ao carregar exames.</div>";
          console.error("Erro ao carregar exames:", error);
        });
    });
  }  
     
  // --------------------------
  // 3. Modal Edita Doutor
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
  // 4. Autocomplete Paciente
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
  // 5. Popular select Doutor
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
  // 6. Modal Edita Agendamento - popular campos e carregar doutores
  // --------------------------
  if (modalEditaAgendamento) {
    modalEditaAgendamento.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      const codpaciente = button.getAttribute("data-codpaciente");
      modalEditaAgendamento.querySelector("#idagendamento").value = button.getAttribute("data-idagendamento") || "";
      modalEditaAgendamento.querySelector("#nome").value = button.getAttribute("data-nome") || "";
      modalEditaAgendamento.querySelector("#email").value = button.getAttribute("data-email") || "";

      // Preenche o hidden do codpaciente (muito importante!)
      modalEditaAgendamento.querySelector("#codPacienteHidden").value = button.getAttribute("data-codpaciente") || "";
      modalEditaAgendamento.querySelector("#codpaciente_exame").value = codpaciente;

  
      //Carregar exames via AJAX
      fetch(`../actions/listar_exames.php?codpaciente=${codpaciente}`)
        .then(response => response.text())
        .then(html => {
          modalEditaAgendamento.querySelector("#listaExames").innerHTML = html;
        })
        .catch(error => {
          modalEditaAgendamento.querySelector("#listaExames").innerHTML = "<div class='text-danger'>Erro ao carregar exames.</div>";
          console.error("Erro ao carregar exames:", error);
        });

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
  // 6. Carregar doutores no modal Novo Agendamento
  // --------------------------
  const selectDoutorNovo = document.getElementById("selectDoutorNovo");
  carregarDoutores(selectDoutorNovo);

  // --------------------------
  // 7. Habilitar botão Enviar Exame apenas se arquivo selecionado
  // --------------------------
  const inputImagem = document.getElementById("imagem");
  const btnEnviarExame = document.getElementById("btnSalvaExame");

  if (inputImagem && btnEnviarExame) {
    // Deixa o botão desabilitado ao carregar a página/modal
    btnEnviarExame.disabled = true;

    inputImagem.addEventListener("change", () => {
      btnEnviarExame.disabled = inputImagem.files.length === 0;
    });
  }

  // --------------------------
  // 8. Máscara de CPF
  // --------------------------
  const cpfInput = document.getElementById("CPFPaciente");

  if (cpfInput) {
    cpfInput.addEventListener("input", function (e) {
      let value = e.target.value.replace(/\D/g, "");
      
      if (value.length > 11) value = value.slice(0, 11);

      if (value.length > 9) {
        value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, "$1.$2.$3-$4");
      } else if (value.length > 6) {
        value = value.replace(/^(\d{3})(\d{3})(\d{0,3})/, "$1.$2.$3");
      } else if (value.length > 3) {
        value = value.replace(/^(\d{3})(\d{0,3})/, "$1.$2");
      }
      e.target.value = value; 
    });
  }

  // --------------------------
  // 9. Máscara de telefone
  // --------------------------
  const telefoneInput = document.getElementById("telefonePaciente");

  if (telefoneInput) {
    telefoneInput.addEventListener("input", function (e) {
      let value = e.target.value.replace(/\D/g, ""); // remove tudo que não é número
      
      if (value.length > 11) value = value.slice(0, 11); // limita a 11 dígitos
      
      if (value.length > 10) {
        // formato (99) 99999-9999
        value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
      } else if (value.length > 5) {
        // formato (99) 9999-9999
        value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
      } else if (value.length > 2) {
        // formato (99) 9999
        value = value.replace(/^(\d{2})(\d{0,5})/, "($1) $2");
      } else {
        value = value.replace(/^(\d*)/, "($1");
      }
      e.target.value = value;
    });
  }
});

  // --------------------------
  // 10. SweetAlert Exclusão
  // --------------------------
document.addEventListener('DOMContentLoaded', function () {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success ms-2",
      cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
  });

  document.querySelectorAll('.btn-excluir').forEach(botao => {
    botao.addEventListener('click', function (event) {
      event.preventDefault();

      const link = this.getAttribute('href');

      swalWithBootstrapButtons.fire({
        title: "Tem certeza?",
        text: "Você não poderá reverter esta ação!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar",
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          swalWithBootstrapButtons.fire({
            title: "Excluído!",
            text: "O registro foi excluído com sucesso.",
            icon: "success",
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.href = link;
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: "O registro não foi excluído.",
            icon: "error"
          });
        }
      });
    });
  });
});

  // --------------------------
  // 11. SweetAlert Exclusão Exames
  // --------------------------
document.addEventListener('click', function(e) {
  const btn = e.target.closest('.btn-excluir-exame');
  if (btn) {
    e.preventDefault();
    const url = btn.getAttribute('href');

    Swal.fire({
      title: 'Tem certeza?',
      text: 'O exame será excluído permanentemente!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sim, excluir!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Excluído!',
          text: 'O exame foi removido com sucesso.',
          icon: 'success',
          timer: 1500,
          showConfirmButton: false
        }).then(() => {
          window.location.href = url;
        });
      }
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  // Seleciona todos os alerts
  const alerts = document.querySelectorAll('.alert');

  alerts.forEach(alert => {
    // Aguarda 2 segundos (2000 ms)
    setTimeout(() => {
      // Usa o método do Bootstrap para esconder com animação
      const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
      bsAlert.close();
    }, 2000);
  });
});