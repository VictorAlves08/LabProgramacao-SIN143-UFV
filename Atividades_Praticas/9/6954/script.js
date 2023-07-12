function getAlunos() {
    $.ajax({
        type: "GET",
        url: "actionsForm.php",
        success: (data) => {
            const dataParse = JSON.parse(data)
            dataParse.map((aluno) => {
                $('#body-table-form')
                    .prepend(`<tr>
                    <td>${aluno.ID_Aluno}</td>
                    <td>${aluno.Nome}</td>
                    <td><a href="view.php?id=${aluno.ID_Aluno}">Visualização Completa</a></td>
                    <td><a href="process.php?id=${aluno.ID_Aluno}" class="btn-edit">Editar</a></td>
                    <td onclick="deleteAluno(${aluno.ID_Aluno})" ><a class="btn-delete">Excluir</a></td>
                    </tr>`)
            })
        }
    });
}

$('#form').submit(
    (e) => {
        e.preventDefault();
        const nome = $("#nome").val();
        const telefone = $("#telefone").val();
        const email = $("#email").val();

        const cidade = $("#cidade").val();
        const bairro = $("#bairro").val();
        const rua = $("#rua").val();
        const numero = $("#numero").val();

        const id_aluno = $("#id_aluno").val();

        $.ajax({
            type: "POST",
            url: "actionsForm.php",
            data: {
                nome: nome,
                telefone: telefone,
                email: email,
                cidade: cidade,
                bairro: bairro,
                rua: rua,
                numero: numero,
                id_aluno: id_aluno
            },
            success: () => {
                alert(`Aluno ${id_aluno ? 'atualizado' : 'cadastrado'} com sucesso!`);

                $("#nome").val('');
                $("#telefone").val('');
                $("#email").val('');

                $("#cidade").val('');
                $("#bairro").val('');
                $("#rua").val('');
                $("#numero").val('');

                $("#id_aluno").val('');
                getAlunos();
            }
        });
    });

function deleteAluno(id) {
    $.ajax({
        type: "DELETE",
        url: "actionsForm.php",
        data: {
            id_aluno: id
        },
        success: () => {
            alert(`Aluno excluído com sucesso!`);
            getAlunos();
        }
    });
}

getAlunos();