<?php

namespace App\Tests\Controller;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuthorControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    /** @var EntityRepository<Author> */
    private EntityRepository $authorRepository;
    private string $path = '/author/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->authorRepository = $this->manager->getRepository(Author::class);

        foreach ($this->authorRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Author index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'author[firstname]' => 'Testing',
            'author[name]' => 'Testing',
            'author[zip]' => 'Testing',
            'author[town]' => 'Testing',
            'author[country]' => 'Testing',
            'author[books]' => 'Testing',
        ]);

        self::assertResponseRedirects('/author');

        self::assertSame(1, $this->authorRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Author();
        $fixture->setFirstname('My Title');
        $fixture->setName('My Title');
        $fixture->setZip('My Title');
        $fixture->setTown('My Title');
        $fixture->setCountry('My Title');
        $fixture->setBooks('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Author');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Author();
        $fixture->setFirstname('Value');
        $fixture->setName('Value');
        $fixture->setZip('Value');
        $fixture->setTown('Value');
        $fixture->setCountry('Value');
        $fixture->setBooks('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'author[firstname]' => 'Something New',
            'author[name]' => 'Something New',
            'author[zip]' => 'Something New',
            'author[town]' => 'Something New',
            'author[country]' => 'Something New',
            'author[books]' => 'Something New',
        ]);

        self::assertResponseRedirects('/author');

        $fixture = $this->authorRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getFirstname());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getZip());
        self::assertSame('Something New', $fixture[0]->getTown());
        self::assertSame('Something New', $fixture[0]->getCountry());
        self::assertSame('Something New', $fixture[0]->getBooks());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Author();
        $fixture->setFirstname('Value');
        $fixture->setName('Value');
        $fixture->setZip('Value');
        $fixture->setTown('Value');
        $fixture->setCountry('Value');
        $fixture->setBooks('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/author');
        self::assertSame(0, $this->authorRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
