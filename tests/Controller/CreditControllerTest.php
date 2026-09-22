<?php

namespace App\Tests\Controller;

use App\Entity\Credit;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CreditControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    /** @var EntityRepository<Credit> */
    private EntityRepository $creditRepository;
    private string $path = '/credit/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->creditRepository = $this->manager->getRepository(Credit::class);

        foreach ($this->creditRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Credit index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'credit[author_name]' => 'Testing',
            'credit[source_url]' => 'Testing',
        ]);

        self::assertResponseRedirects('/credit');

        self::assertSame(1, $this->creditRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Credit();
        $fixture->setAuthorName('My Title');
        $fixture->setSourceUrl('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Credit');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Credit();
        $fixture->setAuthorName('Value');
        $fixture->setSourceUrl('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'credit[author_name]' => 'Something New',
            'credit[source_url]' => 'Something New',
        ]);

        self::assertResponseRedirects('/credit');

        $fixture = $this->creditRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getAuthorName());
        self::assertSame('Something New', $fixture[0]->getSourceUrl());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Credit();
        $fixture->setAuthorName('Value');
        $fixture->setSourceUrl('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/credit');
        self::assertSame(0, $this->creditRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
