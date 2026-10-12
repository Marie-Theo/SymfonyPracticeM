<?php

namespace App\Tests\Controller;

use App\Entity\Answer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AnswerControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    /** @var EntityRepository<Answer> */
    private EntityRepository $answerRepository;
    private string $path = '/answer/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->answerRepository = $this->manager->getRepository(Answer::class);

        foreach ($this->answerRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Answer index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'answer[text]' => 'Testing',
            'answer[is_correct]' => 'Testing',
            'answer[question]' => 'Testing',
        ]);

        self::assertResponseRedirects('/answer');

        self::assertSame(1, $this->answerRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Answer();
        $fixture->setText('My Title');
        $fixture->setIsCorrect('My Title');
        $fixture->setQuestion('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Answer');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Answer();
        $fixture->setText('Value');
        $fixture->setIsCorrect('Value');
        $fixture->setQuestion('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'answer[text]' => 'Something New',
            'answer[is_correct]' => 'Something New',
            'answer[question]' => 'Something New',
        ]);

        self::assertResponseRedirects('/answer');

        $fixture = $this->answerRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getText());
        self::assertSame('Something New', $fixture[0]->getIsCorrect());
        self::assertSame('Something New', $fixture[0]->getQuestion());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Answer();
        $fixture->setText('Value');
        $fixture->setIsCorrect('Value');
        $fixture->setQuestion('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/answer');
        self::assertSame(0, $this->answerRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
