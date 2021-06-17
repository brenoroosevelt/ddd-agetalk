<?php
declare(strict_types=1);

namespace AgetalkDDD\Test;

use AgetalkDDD\Academico\Domain\Model\Aluno;
use AgetalkDDD\Academico\Domain\Model\AlunoId;
use AgetalkDDD\Academico\Domain\Model\Matricula;
use AgetalkDDD\Shared\Domain\Model\Email;
use AgetalkDDD\Test\Stubs\MatriculaSequencia;
use DomainException;
use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase
{
    public function testAlunoCriadoComoAtivoPorPadrao()
    {
        $aluno = new Aluno(
            AlunoId::new(),
            Matricula::novaMatricula(new MatriculaSequencia()),
            'Aluno',
            new Email('aluno@domain.com'),
        );

        $this->assertTrue($aluno->ativo());
    }

    public function testAlunoCriadoComDataCadastroAtual()
    {
        $aluno = new Aluno(
            AlunoId::new(),
            Matricula::novaMatricula(new MatriculaSequencia()),
            'Aluno',
            new Email('aluno@domain.com'),
        );

        $hoje = (new \DateTimeImmutable())->format('d/m/Y');
        $this->assertEquals($hoje, $aluno->dataCadastro()->format('d/m/Y'));
    }

    public function testNaoPermitirCriarAlunoComNomeVazio()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Nome do aluno não pode ser vazio.");

        new Aluno(
            AlunoId::new(),
            Matricula::novaMatricula(new MatriculaSequencia()),
            "",
            new Email('aluno@domain.com'),
        );
    }

    public function testNaoPodeAlterarDadosDeAlunoInativo()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Aluno inativo não pode ser alterado.");

        $aluno = new Aluno(
            AlunoId::new(),
            Matricula::novaMatricula(new MatriculaSequencia()),
            "Aluno",
            new Email('aluno@domain.com'),
        );

        $aluno->desativar();
        $aluno->alterarDadosPessoais("Novo Nome", 'aluno@domain.com');
    }

    public function testPodeAlterarDadosDeAlunoComSucesso()
    {
        $aluno = new Aluno(
            AlunoId::new(),
            Matricula::novaMatricula(new MatriculaSequencia()),
            "Aluno",
            new Email('aluno@domain.com'),
        );

        $aluno->alterarDadosPessoais("Novo Nome", 'aluno2@domain.com');
        $this->assertEquals("Novo Nome", $aluno->nome());
        $this->assertEquals('aluno2@domain.com', $aluno->email());
    }

    public function testDeveDesativarUmAluno()
    {
        $aluno = new Aluno(
            AlunoId::new(),
            Matricula::novaMatricula(new MatriculaSequencia()),
            "Aluno",
            new Email('aluno@domain.com'),
        );

        $aluno->desativar();
        $this->assertFalse($aluno->ativo());
    }
}
