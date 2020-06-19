using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Cors;
using System.Web.Http.Description;
using WebApi.Models;

namespace WebApi.Controllers
{
    [Authorize]
    public class CarsController : ApiController
    {
        private CarServiceDB db = new CarServiceDB();

        // GET: api/Cars
        public IQueryable<Car> GetCars()
        {
            return db.Cars;
        }

        // GET: api/Cars/5
        [ResponseType(typeof(Car))]
        public IHttpActionResult GetCar(long id)
        {
            Car car = db.Cars.Find(id);
            if (car == null)
            {
                return NotFound();
            }

            return Ok(car);
        }

        // GET: api/Cars?name={name}
        [ResponseType(typeof(long))]
        public long GetCar(string name)
        {
            var cars = db.Cars;
            long carId = -1;
            foreach (var car in cars)
            {
                if (car.Name == name)
                {
                    carId = car.CarId;
                }
            }

            return carId;
        }

        // GET: api/Problems?hp={hp}
        [ResponseType(typeof(List<Car>))]
        public IQueryable<Car> GetProblem(double hp)
        {
            if (hp < 0)
            {
                return db.Cars;
            }
            var cars = db.Cars;
            List<Car> car = new List<Car>();
            foreach (var c in cars)
            {
                if (c.HP == hp)
                {
                    car.Add(c);
                }
            }

            return car.AsQueryable<Car>();
        }

        // PUT: api/Cars/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutCar(long id, Car car)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != car.CarId)
            {
                return BadRequest();
            }

            db.Entry(car).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!CarExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/Cars
        [ResponseType(typeof(Car))]
        public IHttpActionResult PostCar(Car car)
        {
                if (!ModelState.IsValid)
                {
                    return BadRequest(ModelState);
                }

            if (CheckFields(car))
            {

                db.Cars.Add(car);
                db.SaveChanges();

                return CreatedAtRoute("DefaultApi", new { id = car.CarId }, car);
            }
            else
            {
                return BadRequest();
            }

        }

        private bool CheckFields(Car car)
        {
            if (car.Name==null||car.Name.Length>50)
            {
                return false;
            }
            else if (car.Model == null || car.Model.Length > 50)
            {
                return false;
            }else if (car.HP<0)
            {
                return false;
            }else if (car.RecNumber == null || car.RecNumber.Length>8)
            {
                return false;
            }
            else if (car.ProblemId<0)
            {
                return false;
            }
            return true;
        }

        // DELETE: api/Cars/5
        [ResponseType(typeof(Car))]
        public IHttpActionResult DeleteCar(long id)
        {
            Car car = db.Cars.Find(id);
            if (car == null)
            {
                return NotFound();
            }

            db.Cars.Remove(car);
            db.SaveChanges();

            return Ok(car);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool CarExists(long id)
        {
            return db.Cars.Count(e => e.CarId == id) > 0;
        }
    }
}