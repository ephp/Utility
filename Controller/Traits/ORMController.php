<?php

namespace JF\UtilityBundle\Controller\Traits;

trait ORMController {

    /**
     * @return \Doctrine\ORM\EntityManager 
     */
    protected function getEm() {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Restituisce il repository richiesto
     * 
     * @param type $classe nome del repository
     * @return \Doctrine\ORM\EntityRepository 
     */
    protected function getRepository($classe) {
        return $this->getEm()->getRepository($classe);
    }

    /**
     * Fa il find da un repository
     * 
     * @param string $classe nome del repository
     * @param array $id id dell'oggetto
     * @return Mixed
     */
    protected function find($classe, $id) {
        return $this->getRepository($classe)->find($id);
    }

    /**
     * Fa il findAll da un repository
     * 
     * @param string $classe nome del repository
     * @param array $find array con i criteri di ricerca
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    protected function findAll($classe) {
        return $this->getRepository($classe)->findAll();
    }

    /**
     * Fa il findBy da un repository
     * 
     * @param string $classe nome del repository
     * @param array $find array con i criteri di ricerca
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    protected function findBy($classe, $find, $order = array(), $limit = null, $from = null) {
        return $this->getRepository($classe)->findBy($find, $order, $limit, $from);
    }

    /**
     * Fa il findOneBy da un repository
     * 
     * @param string $classe nome del repository
     * @param array $find array con i criteri di ricerca
     * @return Mixed
     */
    protected function findOneBy($classe, $find, $order = array()) {
        return $this->getRepository($classe)->findOneBy($find, $order);
    }

    /**
     * Fa il getQbAll da un repository
     * 
     * @param string $classe nome del repository
     * @param array $getQb array con i criteri di ricerca
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function createQueryBuilder($classe) {
        return $this->getRepository($classe)->createQueryBuilder('q');
    }

    /**
     * Fa il getQbBy da un repository
     * 
     * @param string $classe nome del repository
     * @param array $getQb array con i criteri di ricerca
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    protected function createQueryBuilderBy($classe, $find, $order = array(), $limit = null, $from = null) {
        $qb = $this->getQbAll($classe);
        foreach ($find as $field => $value) {
            $qb->andWhere("q.{$field} = :{$field}")
                    ->setParameter("{$field}", $value);
        }
        foreach ($order as $field => $mode) {
            $qb->addOrderBy($field, $mode);
        }
        if($limit) {
            $qb->setMaxResults($limit);
        }
        if($from) {
            $qb->setFirstResult($from);
        }
        return $qb;
    }

    /**
     * Restituisce il repository richiesto
     * 
     * @param type $classe entity da persistere
     */
    protected function persist($entity) {
        $this->getEm()->persist($entity);
        $this->getEm()->flush();
    }

    /**
     * Restituisce il repository richiesto
     * 
     * @param type $classe entity da persistere
     */
    protected function remove($entity) {
        $this->getEm()->remove($entity);
        $this->getEm()->flush();
    }

    /**
     * Fa il SELECT * da un repository o esegue una query
     * 
     * @param string $classe nome del repository
     * @param array $find array con i criteri di ricerca
     * @return Mixed
     */
    protected function executeDql($classe, $find = array()) {
        $repo = $this->getRepository($classe);
        /* @var $repo \Doctrine\ORM\EntityRepository */
        $qb = $repo->createQueryBuilder('c');
        foreach ($find as $key => $value) {
            $qb->andWhere("c.{$key} = :{$key}")
                    ->setParameter($key, $value);
        }
        $out = $qb->getQuery()->execute();
        return $out;
    }

    /**
     * Fa il SELECT usando una query SQL
     * C'è il controllo che sia SELECT COUNT(*) FROM o scoppia
     * 
     * @param string $sql query sql
     * @param array $params array con i criteri di ricerca
     * @return Mixed
     */
    protected function executeSql($sql, $params = array()) {
        $em = $this->getEm();
        /* @var $em \Doctrine\ORM\EntityManager */
        $conn = $em->getConnection();
        /* @var $conn \Doctrine\DBAL\Connection */
        $stmt = $conn->executeQuery($sql, $params);
        $out = $stmt->fetchAll();
        return $out;
    }

    /**
     * Fa il SELECT usando una query SQL
     * C'è il controllo che sia SELECT COUNT(*) FROM o scoppia
     * 
     * @param string $sql query sql
     * @param array $params array con i criteri di ricerca
     * @return integer
     */
    protected function updateSql($sql, $params = array()) {
        $em = $this->getEm();
        /* @var $em \Doctrine\ORM\EntityManager */
        $conn = $em->getConnection();
        /* @var $conn \Doctrine\DBAL\Connection */
        $out = $conn->executeUpdate($sql, $params);
        return $out;
    }

    /**
     * Fa il SELECT * da un repository o esegue una query
     * 
     * @param string $classe nome del repository
     * @param array $find array con i criteri di ricerca
     * @return Mixed
     */
    protected function countDql($classe, $find = array()) {
        $repo = $this->getRepository($classe);
        /* @var $repo \Doctrine\ORM\EntityRepository */
        $qb = $repo->createQueryBuilder('c')->select('COUNT(c)');
        foreach ($find as $key => $value) {
            $qb->andWhere("c.{$key} = :{$key}")
                    ->setParameter($key, $value);
        }
        $out = $qb->getQuery()->getScalarResult();
        return intval($out[0][1]);
    }

    /**
     * Fa il SELECT COUNT(*) usando una query SQL
     * C'è il controllo che sia SELECT COUNT(*) FROM o scoppia
     * 
     * @param string $sql query sql
     * @param array $params array con i criteri di ricerca
     * @return Mixed
     */
    protected function countSql($sql, $params = array()) {
        if (!preg_match('/^[ \n\r\t]*select[ \n\r\t]+count\(\*\)[ \n\r\t]+from[ \n\r\t]+/i', $sql)) {
            $sql = 'SELECT COUNT(*) FROM ' . $sql;
        }
        $em = $this->getEm();
        /* @var $em \Doctrine\ORM\EntityManager */
        $conn = $em->getConnection();
        $stmt = $conn->executeQuery($sql, $params);
        $out = $stmt->fetch();
        return intval(array_shift($out));
    }

}
